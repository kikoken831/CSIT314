package com.example.bugreporter;

import android.content.ContentValues;
import android.content.Context;

import java.util.ArrayList;

public class ReviewerReviewBugsController {
    Bug bug;

    public ReviewerReviewBugsController(Context context)
    {
        bug = new Bug(context);
    }

    public ArrayList<String> getPendingReviewBugs()
    {
        ArrayList<String> list = bug.getBugByCaseStatus("pending review");

        return list;
    }

    public long updatePendingReviewBugs(String bugid)
    {
        long rowid;
        String caseStatus = bug.getCaseStatus(bugid);
        if(caseStatus.equals("pending review"))
        {
            ContentValues values = new ContentValues();
            values.put(bug.caseStatus(), "reviewed");
            rowid = bug.update(values, bugid);
        }

        else
            rowid = -1;

        return rowid;
    }


}
