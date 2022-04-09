package com.example.bugreporter;

import android.content.ContentValues;
import android.content.Context;

import java.util.ArrayList;

public class DeveloperMyBugsController {
    Bug bug;

    public DeveloperMyBugsController(Context context)
    {
        bug = new Bug(context);
    }

    public ArrayList<String> getMyBugs(String username)
    {
        ArrayList<String> list = bug.getBugsByDev(username);

        return list;
    }

    public long updatePending(String bugid, String dev)
    {
        String caseStatus = bug.getCaseStatus(bugid);
        String assignedTo = bug.getAssignedTo(bugid);
        long rowid;

        if(caseStatus.equals("open") && assignedTo.equals(dev))
        {
            String date = new java.sql.Date(System.currentTimeMillis()).toString();

            ContentValues values = new ContentValues();
            values.put(bug.bugid(), bugid);
            values.put(bug.status(), "resolved");
            values.put(bug.resolvedOn(), date);
            values.put(bug.caseStatus(), "pending review");

            rowid = bug.update(values, bugid);
        }

        else
            rowid = -2;

        return rowid;

    }
}
