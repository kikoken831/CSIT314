package com.example.bugreporter;

import android.content.Context;

import java.util.ArrayList;

public class TriagerReportBestPerfDevController {
    Bug bug;

    public TriagerReportBestPerfDevController(Context context)
    {
        bug = new Bug(context);
    }

    public ArrayList<String> getBestPerformedDeveloper()
    {
        ArrayList<String> list = bug.getBestPerformedDeveloper();

        return list;
    }

}
