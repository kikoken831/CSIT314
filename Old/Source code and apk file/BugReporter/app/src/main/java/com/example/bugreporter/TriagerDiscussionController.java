package com.example.bugreporter;

import android.content.ContentValues;
import android.content.Context;

import java.util.ArrayList;

public class TriagerDiscussionController {
    Forum forum;

    public TriagerDiscussionController(Context context)
    {
        forum = new Forum(context);
    }

    public ArrayList<String> getBugForum(String id)
    {
        ArrayList<String> list = forum.getForumByID(id);
        return list;
    }

    long insertComment(String username, String id, String comment)
    {
        ContentValues contentValues = new ContentValues();
        contentValues.put(forum.commentBy(), username);
        contentValues.put(forum.commentOn(), id);
        contentValues.put(forum.comment(), comment);

        long rowID = forum.insert(contentValues);

        return rowID;
    }
}
