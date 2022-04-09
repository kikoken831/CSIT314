package com.example.bugreporter;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;

import com.readystatesoftware.sqliteasset.SQLiteAssetHelper;

import java.util.ArrayList;

public class Forum extends SQLiteAssetHelper{
    Context context;

    private static final String DATABASE_NAME = "BugReporter";
    private static final int DATABASE_Version = 1;

    // Comment table
    private static final String TABLE_COMMENT = "comment_table";
    private static final String commentid = "comment_id";
    private static final String commentBy = "comment_by"; //user id
    private static final String commentOn = "comment_on"; //bug id
    private static final String comment = "comment";

    public Forum(Context context)
    {
        super(context, DATABASE_NAME, null, DATABASE_Version);
        this.context = context;
    }

    public ArrayList<String> getForumByID(String id)
    {
        String query = "SELECT * FROM " + this.TABLE_COMMENT + " WHERE " + this.commentOn + " = ?";
        String[] args = {id};

        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Comment By: " + cursor.getString(1) + "\n Comment On: " +
                    cursor.getString(2) + "\n Comment: " + cursor.getString(3)));
        }

        return list;
    }

    public long insert(ContentValues values)
    {
        long rowID = this.getWritableDatabase().insert("comment_table", null, values);
        return rowID;
    }

    public String TABLE_COMMENT()
    {
        return TABLE_COMMENT;
    }

    public String commentid()
    {
        return commentid;
    }

    public String commentBy()
    {
        return commentBy;
    }

    public String commentOn()
    {
        return commentOn;
    }

    public String comment()
    {
        return comment;
    }
}
