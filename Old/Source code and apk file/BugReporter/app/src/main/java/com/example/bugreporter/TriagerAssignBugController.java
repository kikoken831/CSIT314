package com.example.bugreporter;

import android.content.ContentValues;
import android.content.Context;

import java.util.ArrayList;

public class TriagerAssignBugController {
    Bug bug;
    User user;

    public TriagerAssignBugController(Context context)
    {
        bug = new Bug(context);
        user = new User(context);
    }

    public ArrayList<String> getUnassignedBug()
    {
        ArrayList<String> list = bug.getBugsByDevAndCaseStatus("unassigned");

        return list;
    }

    public long assign(String bugid, String username, String allocatedBy)
    {
        int count = user.checkExist(username);
        long rowid;
        if(count == 1)
        {
            String assignedTo = bug.getAssignedTo(bugid);
            String caseStatus = bug.getCaseStatus(bugid);


            if(assignedTo.equals("unassigned") && caseStatus.equals("open"))
            {
                ContentValues values = new ContentValues();
                values.put(bug.assignedTo(), username);
                values.put(bug.allocatedBy(), allocatedBy);

                rowid = bug.update(values, bugid);
            }

            else
                rowid = -2;
        }

        else
            rowid = -3;

        return rowid;
    }

    public ArrayList<String> getDevelopers()
    {
        ArrayList<String> list = user.getUsersByRole("developer");

        return list;
    }
}
