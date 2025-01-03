<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDescription;
use App\Models\CourseHistory1;
use App\Models\CourseRegistration;
use App\Models\SellingInvoice;
use Illuminate\Http\Request;
use Log;
use Str;
use Validator;

class CourseController extends Controller
{
    public function index()
    {
        // Fetch all course descriptions with their associated courses
        $courseDescriptions = CourseDescription::with('course')->get();

        return view('owner.pages.courses.courses', compact('courseDescriptions'));
    }


    public function create()
    {
        return view('owner.pages.courses.create-courses');
    }
    public function store(Request $request)
    {
        try {
            // 1. Handle the course image upload
            $courseImagePath = null;
            if ($request->hasFile('course_image')) {
                try {
                    $image = $request->file('course_image');
                    $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/course_images', $imageName);
                    $courseImagePath = 'storage/course_images/' . $imageName;
                    Log::info("Course image uploaded successfully: " . $courseImagePath);
                } catch (\Exception $e) {
                    Log::error("Error uploading course image: " . $e->getMessage());
                    return redirect()
                        ->back()
                        ->with('error', 'Error uploading image: ' . $e->getMessage())
                        ->withInput();
                }
            } else {
                Log::info("No course image uploaded.");
            }

            // 2. Create the course record
            try {
                $course = Course::create([
                    'course_name' => $request->course_name,
                    'course_slug' => $request->course_slug,
                    'price' => $request->price,
                    'sessions' => $request->sessions,
                    'is_active' => $request->is_active,
                ]);
                Log::info("Course created successfully: " . $course->course_name);
            } catch (\Exception $e) {
                Log::error("Error creating course record: " . $e->getMessage());
                return redirect()
                    ->back()
                    ->with('error', 'Error creating course: ' . $e->getMessage())
                    ->withInput();
            }

            // 3. Create the course description record
            try {
                CourseDescription::create([
                    'course_id' => $course->course_id,
                    'free_items' => $request->free_items,
                    'course_image' => $courseImagePath,
                    'benefits' => $request->benefits,
                    'description' => $request->description, // Insert the description here
                ]);
                Log::info("Course description created successfully for course: " . $course->course_name);
            } catch (\Exception $e) {
                Log::error("Error creating course description: " . $e->getMessage());
                return redirect()
                    ->back()
                    ->with('error', 'Error creating course description: ' . $e->getMessage())
                    ->withInput();
            }

            // Final step: redirect with success
            return redirect()->route('courses.index')->with('success', 'Course created successfully.');

        } catch (\Exception $e) {
            Log::error("General error during course creation: " . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Error creating course: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function edit($course_id)
    {
        // Use course_id as the primary key to find the course
        $course = Course::with('description')->where('course_id', $course_id)->firstOrFail();
        return view('owner.pages.courses.edit-courses', compact('course'));
    }


    public function update(Request $request, $course_id)
    {
        // Step 1: Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'course_name' => 'required|string|max:100',
            'course_slug' => 'required|string|max:100|unique:courses,course_slug,' . $course_id . ',course_id',
            'price' => 'required|numeric',
            'sessions' => 'required|integer',
            'is_active' => 'required|boolean',
            'free_items' => 'nullable|string',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'benefits' => 'nullable|string',
            'description' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            dd('Validation failed', $validator->errors());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Retrieve the existing course and description
            $course = Course::with('description')->where('course_id', $course_id)->firstOrFail();

            // Step 3: Handle course image upload if provided
            $courseImagePath = $course->description->course_image ?? null;
            if ($request->hasFile('course_image')) {

                // Delete the old image if it exists
                if ($courseImagePath) {
                    \Storage::disk('public')->delete($courseImagePath);
                }

                // Store the new image
                $image = $request->file('course_image');
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/course_images', $imageName);
                $courseImagePath = 'storage/course_images/' . $imageName;

            }

            // Step 4: Update the course record
            $course->update([
                'course_name' => $request->course_name,
                'course_slug' => $request->course_slug,
                'price' => $request->price,
                'sessions' => $request->sessions,
                'is_active' => $request->is_active,
            ]);


            // Step 5: Update the course description or create it if it doesn’t exist
            $descriptionUpdate = $course->description()->updateOrCreate(
                ['course_id' => $course->course_id],
                [
                    'free_items' => $request->free_items,
                    'course_image' => $courseImagePath,
                    'benefits' => $request->benefits,
                    'description' => $request->description,
                ]
            );


            return redirect()->route('courses.index')->with('success', 'Course updated successfully.');

        } catch (\Exception $e) {
            dd("Error updating course with ID: {$course_id}", $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Error updating course: ' . $e->getMessage())
                ->withInput();
        }
    }



    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        // Delete course description and image if available
        if ($course->description && $course->description->course_image) {
            \Storage::disk('public')->delete($course->description->course_image);
        }
        $course->description()->delete();
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function userIndex()
    {
        $courses = Course::where('is_active', 1)
            ->with(['description'])
            ->get();

        return view('user.pages.course', compact('courses'));
    }

    public function showCourse($course_slug)
    {
        $course = Course::where('course_slug', $course_slug)
            ->where('is_active', 1)
            ->with('description')
            ->firstOrFail();

        return view('user.pages.course-details', compact('course'));
    }

    public function courseRegistration()
    {
        // Ambil data CourseDescription
        $courseDescriptions = CourseDescription::with('course')->get();

        // Ambil CourseRegistrations dengan data dari CourseHistory1
        $courseRegistrations = CourseRegistration::select(
            'course_registrations.*',
            'course_history1.order_date',
            'course_history1.invoice_code',
            'course_history1.order_status'
        )
            ->leftJoin('course_history1', 'course_registrations.invoice_code', '=', 'course_history1.invoice_code')
            ->with('course', 'user')
            ->get();

        // Kirim data ke view
        return view('owner.pages.courses.course-registration', compact('courseDescriptions', 'courseRegistrations'));
    }


    public function viewCourseHistory($registration_id)
    {
        // Ambil data dari CourseRegistration dan CourseHistory1 berdasarkan registration_id
        $courseRegistration = CourseRegistration::with('course', 'user')->find($registration_id);

        // dd($courseRegistration);
        if (!$courseRegistration) {
            return redirect()->back()->with('error', 'Course registration not found.');
        }

        $courseHistory = CourseHistory1::where('registration_id', $registration_id)->first();

        if (!$courseHistory) {
            return redirect()->back()->with('error', 'Course history not found.');
        }

        // Mengambil invoice_code dari course history
        $invoiceCode = $courseHistory->invoice_code;

        $invoice = SellingInvoice::with('details')->where('invoice_code', $invoiceCode)->first();
        // Kirim data ke view
        return view('owner.pages.courses.course-registration-detail', compact('courseRegistration', 'invoice', 'courseHistory', 'invoiceCode'));
    }

    public function updateStatus(Request $request, $invoiceId)
    {
        $invoice = SellingInvoice::find($invoiceId);

        if ($invoice) {
            // Update status pesanan
            $invoice->order_status = $request->input('status');
            $invoice->save();

            return redirect()->back()->with('success', 'Pesanan telah diterima dan status diubah menjadi Completed');
        }

        return redirect()->back()->with('error', 'Pesanan tidak ditemukan');
    }
    public function updateSessionPlus(Request $request, $registrationId)
    {
        Log::info("updateSessionPlus called for registrationId: $registrationId"); // Log untuk debugging

        // Temukan data course registration berdasarkan ID
        $registration = CourseRegistration::find($registrationId);

        if ($registration) {
            // Ambil total sessions dari course yang terkait
            $totalSessions = $registration->course->sessions;

            // Pastikan sesi belum mencapai total
            if ($registration->sessions_completed < $totalSessions) {
                $registration->sessions_completed += 1;
                $registration->save();

                return response()->json(['success' => true]);
            }

            return response()->json(['error' => 'Jumlah sesi sudah mencapai total.']);
        }

        return response()->json(['error' => 'Registrasi tidak ditemukan.']);
    }
    public function updateSessionMinus(Request $request, $registrationId)
    {
        Log::info("updateSessionMinus called for registrationId: $registrationId"); // Log untuk debugging

        // Temukan data course registration berdasarkan ID
        $registration = CourseRegistration::find($registrationId);

        if ($registration) {
            // Pastikan sesi tidak kurang dari 0
            if ($registration->sessions_completed > 0) {
                $registration->sessions_completed -= 1;
                $registration->save();

                return response()->json(['success' => true]);
            }

            return response()->json(['error' => 'Jumlah sesi tidak bisa kurang dari 0.']);
        }

        return response()->json(['error' => 'Registrasi tidak ditemukan.']);
    }


}
