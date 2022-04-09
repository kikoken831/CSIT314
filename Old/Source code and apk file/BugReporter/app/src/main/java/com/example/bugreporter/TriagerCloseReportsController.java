package com.example.bugreporter;

import android.content.ContentValues;
import android.content.Context;

import java.util.ArrayList;

public class TriagerCloseReportsController {
    Bug bug;

    public TriagerCloseReportsController(Context context) {
        bug = new Bug(context);
    }

    public ArrayList<String> getReviewedBugs()
    {
        ArrayList<String> list = bug.getBugByCaseStatus("reviewed");

        return list;
    }

    public long closeBugReports(String bugid)
    {

        String caseStatus = bug.getCaseStatus(bugid);
        long rowid;

        if(caseStatus.equals("reviewed"))
        {
            ContentValues values = new ContentValues();
            values.put(bug.caseStatus(), "closed");

            rowid = bug.update(values, bugid);
        }

        else
            rowid = -2;

        return rowid;
    }
}
