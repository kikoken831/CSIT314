package com.example.bugreporter;

import android.content.ContentValues;
import android.content.Context;

import java.util.ArrayList;

public class TriagerInvalidBugController {
    Bug bug;

    public TriagerInvalidBugController(Context context)
    {
        bug = new Bug(context);
    }

    public long updateInvalidBug(String bugid)
    {
        String currentStatus = bug.getStatus(bugid);
        long rowid;

        if(currentStatus.equals("unresolved"))
        {
            ContentValues values = new ContentValues();
            values.put(bug.status(), "invalid");
            values.put(bug.caseStatus(), "closed");

            rowid = bug.update(values, bugid);
        }

        else
            rowid = -2;

        return rowid;
    }

    public ArrayList<String> getUnresolvedBugs()
    {
        ArrayList<String> list = bug.getBugByStatus("unresolved");

        return list;
    }
}
