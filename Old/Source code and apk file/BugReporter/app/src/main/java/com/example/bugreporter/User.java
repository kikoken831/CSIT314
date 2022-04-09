package com.example.bugreporter;

import android.content.Context;
import android.database.Cursor;

import com.readystatesoftware.sqliteasset.SQLiteAssetHelper;

import java.util.ArrayList;

public class User extends SQLiteAssetHelper
{
    private static final String DATABASE_NAME = "BugReporter";
    private static final int DATABASE_Version = 1;

    private static final String TABLE_USER = "users_table";
    private static final String userid = "user_id";
    private static final String username = "username";
    private static final String password = "password";
    private static final String role = "role"; // reporter, developer, triager, reviewer

    Context context;


    public User(Context context)
    {
        super(context, DATABASE_NAME, null, DATABASE_Version);
        this.context = context;
    }

    public int checkUser(String inputUsername, String inputPassword)
    {
        String query = "SELECT * FROM " + TABLE_USER + " WHERE " + username + " = ? AND " + password + " = ?";
        String[] args = {inputUsername, inputPassword};
        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        int count = cursor.getCount();

        cursor.close();

        return count;
    }


    public int checkExist(String inputUsername)
    {
        String query = "SELECT * FROM " + TABLE_USER + " WHERE " + username + " = ?";
        String[] args = {inputUsername};
        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        int count = cursor.getCount();

        cursor.close();

        return count;
    }

    public String getRole(String inputUsername, String inputPassword)
    {
        String query = "SELECT role FROM " + TABLE_USER + " WHERE " + username + " = ? AND " + password + " = ?";
        String[] args = {inputUsername, inputPassword};
        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        String role = "";
        while (cursor.moveToNext()) {
            role = cursor.getString(0);
        }
        return role;
    }

    public ArrayList<String> getUsersByRole(String role)
    {
        ArrayList<String> list = new ArrayList<String>();
        String query = "SELECT * FROM " + this.TABLE_USER + " WHERE " + this.role + " = ?";
        String[] args = {role};

        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        while (cursor.moveToNext())
        {
            list.add(("User ID: " + cursor.getString(0) + "\n Username: " + cursor.getString(1) + "\n Role: " + cursor.getString(3)));
        }

        return list;
    }

    public ArrayList<String> searchDeveloper(String keyword){
        String query = "SELECT * FROM "+ this.TABLE_USER + " WHERE " + this.role + " = 'developer' AND (" +
                this.userid + " = '" + keyword + "' OR " +
                this.username + " = '" + keyword + "');";

        Cursor cursor = this.getReadableDatabase().rawQuery(query, null);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("User ID: " + cursor.getString(0) + "\n Username: " + cursor.getString(1) + "\n Role: " + cursor.getString(3)));
        }

        return list;
    }

}
