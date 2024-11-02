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

        return view('members.index', compact('members'));
    }

    /**
     * Display the specified member.
     */
    public function show($memberId)
    {
        $member = Member::with('user')->findOrFail($memberId);
        return view('members.show', compact('member'));
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
}