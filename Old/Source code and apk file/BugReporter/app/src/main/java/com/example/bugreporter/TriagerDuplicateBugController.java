package com.example.bugreporter;

import android.content.ContentValues;
import android.content.Context;

public class TriagerDuplicateBugController {
    Bug bug;

    public TriagerDuplicateBugController(Context context)
    {
        bug = new Bug(context);
    }

    public long updateDuplicatedBug(String bugid)
    {
        String currentStatus = bug.getStatus(bugid);
        long rowid;

        if(currentStatus.equals("unresolved"))
        {
            ContentValues values = new ContentValues();
            values.put(bug.status(), "duplicated");
            values.put(bug.caseStatus(), "closed");

            rowid = bug.update(values, bugid);
        }

        else
            rowid = -2;

        return rowid;
    }
}
