package com.example.bugreporter;

import android.content.Context;

import java.util.ArrayList;

public class TriagerReportNumByDateController {
    Bug bug;

    public TriagerReportNumByDateController(Context context)
    {
        bug = new Bug(context);
    }

    public ArrayList<String> getNumberOfBugsReported(String startDate, String endDate)
    {
        ArrayList<String> list = bug.getNumberOfBugsReported(startDate, endDate);

        return list;
    }

    public ArrayList<String> getNumberofBugsResolved(String startDate, String endDate)
    {
        ArrayList<String> list = bug.getNumberofBugsResolved(startDate, endDate);

        return list;
    }
}
