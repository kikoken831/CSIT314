package com.example.bugreporter;

import android.content.ContentValues;
import android.content.Context;

public class ReporterReportFormController {
    Bug bug;

    public ReporterReportFormController(Context context)
    {
        bug = new Bug(context);
    }

    public long insertBug(String bugtitle, String bugdesc, String reportedby)
    {
        String date = new java.sql.Date(System.currentTimeMillis()).toString();

        ContentValues contentValues = new ContentValues();
        contentValues.put(bug.bugtitle(), bugtitle);
        contentValues.put(bug.bugDesc(), bugdesc);
        contentValues.put(bug.status(), "unresolved");
        contentValues.put(bug.reportedBy(), reportedby);
        contentValues.put(bug.assignedTo(), "unassigned");
        contentValues.put(bug.allocatedBy(), "unallocated");
        contentValues.put(bug.reportedOn(), date);
        contentValues.put(bug.resolvedOn(), (String) null);
        contentValues.put(bug.caseStatus(), "open");

        long id = bug.insert(contentValues);

        return id;
    }
}
