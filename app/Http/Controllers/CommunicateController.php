<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NoticeBoardModel;
use App\Models\NoticeBoardMessageModel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CommunicateController extends Controller
{
    public function NoticeBoard(Request $request)
    {
        $data['getRecord'] = NoticeBoardModel::getRecord($request);
        $data['header_title'] = 'Notice Board';
        return view('admin.communicate.noticeboard.list', $data);
    }

    //Headmaster Part
    public function NoticeBoardHeadmaster(Request $request)
    {
        $data['getRecord'] = NoticeBoardModel::getRecord($request);
        $data['header_title'] = ' My Notice Board';
        return view('headmaster.my_notice_board', $data);
    }

    //STAD Part
    public function NoticeBoardStad(Request $request)
    {
        $data['getRecord'] = NoticeBoardModel::getRecord($request);
        $data['header_title'] = ' My Notice Board';
        return view('stad.my_notice_board', $data);
    }

    public function AddNoticeBoard()
    {
        $data['header_title'] = 'Add New Notice Board';
        return view('admin.communicate.noticeboard.add', $data);
    }

    public function InsertNoticeBoard(Request $request)
    {
        $save = new NoticeBoardModel;
        $save->title = $request->title;
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = $request->message;
        $save->created_by = Auth::user()->id;
        $save->save();

        if (!empty($request->message_to)) {
            foreach ($request->message_to as $message_to) {
                $message = new NoticeBoardMessageModel;
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }

        return redirect('admin/communicate/notice_board')->with('success', "Notice Board  successfully created");
    }

    public function EditNoticeBoard($id)
    {
        $data['getRecord'] = NoticeBoardModel::getSingle($id);
        $data['header_title'] = ' Edit Notice Board';
        return view('admin.communicate.noticeboard.edit', $data);
    }

    public function UpdateNoticeBoard($id, Request $request)
    {
        $save = NoticeBoardModel::getSingle($id);
        $save->title = $request->title;
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = $request->message;
        $save->created_by = Auth::user()->id;
        $save->save();

        NoticeBoardMessageModel::DeleteRecord($id);

        if (!empty($request->message_to)) {
            foreach ($request->message_to as $message_to) {
                $message = new NoticeBoardMessageModel;
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }

        return redirect('admin/communicate/notice_board')->with('success', "Notice Board successfully updated");
    }

    public function DeleteNoticeBoard($id)
    {
        $save = NoticeBoardModel::getSingle($id);
        $save->delete();

        NoticeBoardMessageModel::DeleteRecord($id);

        return redirect()->back()->with('success', "Notice Board successfully deleted");
    }


    //Teacher Part
    public function MyNoticeBoardTeacher(Request $request)
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->user_type, $request);
        $data['header_title'] = ' My Notice Board';
        return view('teacher.my_notice_board', $data);
    }
}
