<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of members.
     */
    public function index()
    {
        // Mengambil data member dengan relasi user
        $members = Member::with('user')->paginate(10);

        return view('owner.pages.members.members', compact('members'));
    }


    /**
     * Display active members.
     */
    public function activeMembers()
    {
        $members = Member::with('user')
            ->where('is_active', true)
            ->paginate(10);

        return view('members.active', compact('members'));
    }

    /**
     * Display members by points range.
     */
    public function membersByPoints($minPoints = 0)
    {
        $members = Member::with('user')
            ->where('points', '>=', $minPoints)
            ->orderBy('points', 'desc')
            ->paginate(10);

        return view('members.by_points', compact('members', 'minPoints'));
    }

    public function edit($memberId)
    {
        $member = Member::with('user')->findOrFail($memberId);
        return view('owner.pages.members.members-edit', compact('member'));
    }

    public function update(Request $request, $memberId)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'membership_number' => 'required|string|max:255',
            'points' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
            'joined_date' => 'required|date',
        ]);

        // Find the member and update the details
        $member = Member::with('user')->findOrFail($memberId);
        $member->user->nama_depan = $request->first_name;
        $member->user->nama_belakang = $request->last_name;
        $member->membership_number = $request->membership_number;
        $member->points = $request->points;
        $member->is_active = $request->is_active;
        $member->joined_date = $request->joined_date;

        $member->user->save();
        $member->save();

        return redirect()->route('members.index')->with('success', 'Member updated successfully');
    }



    public function destroy($memberId)
    {
        $member = Member::findOrFail($memberId);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully');
    }

}