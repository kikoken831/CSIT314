package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.SearchView;
import android.widget.Toast;

import java.util.ArrayList;

public class TriagerReportBestPerfDevActivity extends AppCompatActivity {
    ListView listView;
    ArrayList<String> list;
    ArrayAdapter adapter;
    TriagerReportBestPerfDevController triagerReportBestPerfDevController;
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_triager_report_best_perf_dev);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);
        listView = (ListView)findViewById(R.id.list_developer);
        triagerReportBestPerfDevController = new TriagerReportBestPerfDevController(this);
        list = new ArrayList<>();

        viewBestPerfDev();

    }

    private void viewBestPerfDev(){
        list = triagerReportBestPerfDevController.getBestPerformedDeveloper();

        if (list.size() == 0){
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewList(list);
        }
    }

    private void viewList(ArrayList<String> list)
    {
        adapter = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
        listView.setAdapter(adapter);
    }

    public void ClickMenu(View view){
        NavBarActivity.openDrawer(drawerLayout);
    }

    public void ClickLogo(View view){
        NavBarActivity.closeDrawer(drawerLayout);
    }

    public void ClickTriagerHome(View view){
        NavBarActivity.redirectActivity(TriagerReportBestPerfDevActivity.this, TriagerHomeActivity.class);
    }

    public void ClickAssignBug(View view){
        NavBarActivity.redirectActivity(TriagerReportBestPerfDevActivity.this, TriagerAssignBugActivity.class);
    }

    public void ClickTriagerDiscuss(View view){
        NavBarActivity.redirectActivity(TriagerReportBestPerfDevActivity.this, TriagerDiscussionActivity.class);
    }

    public void ClickTriagerAllBug(View view){
        NavBarActivity.redirectActivity(TriagerReportBestPerfDevActivity.this, TriagerAllBugActivity.class);
    }

    public void ClickTriagerReport(View view){
        NavBarActivity.redirectActivity(TriagerReportBestPerfDevActivity.this, TriagerReportActivity.class);
    }

    public void ClickInvalidBug(View view){
        NavBarActivity.redirectActivity(TriagerReportBestPerfDevActivity.this, TriagerUpdateDuplicateAndInvalidBugActivity.class);
    }

    public void ClickTriagerCloseReports(View view){
        NavBarActivity.redirectActivity(TriagerReportBestPerfDevActivity.this, TriagerCloseReportsActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(TriagerReportBestPerfDevActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }

}