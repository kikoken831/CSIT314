package com.example.bugreporter;

import android.content.Context;

import java.util.ArrayList;

public class TriagerReportBestPerfRepController {
    Bug bug;

    public TriagerReportBestPerfRepController(Context context)
    {
        bug = new Bug(context);
    }

    public ArrayList<String> getBestPerformedReporter()
    {
        ArrayList<String> list = bug.getBestPerformedReporter();

        return list;
    }
}
