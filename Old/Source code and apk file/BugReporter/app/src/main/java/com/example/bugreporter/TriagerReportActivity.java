package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class TriagerReportActivity extends AppCompatActivity {
    Button btnNumByDate, btnBestPerfDev, btnBestPerfRep;
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_triager_report);

        btnNumByDate = (Button)findViewById(R.id.buttonNumByDate);
        btnBestPerfDev = (Button)findViewById(R.id.buttonBestPerfDev);
        btnBestPerfRep = (Button)findViewById(R.id.buttonBestPerfRep);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);

        btnNumByDate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navReportNumByDate();
            }
        });

        btnBestPerfDev.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navReportBestPerfDev();
            }
        });

        btnBestPerfRep.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navReportBestPerfRep();
            }
        });

    }

    private void navReportNumByDate(){
        Intent intent = new Intent(TriagerReportActivity.this, TriagerReportNumByDateActivity.class);
        startActivity(intent);
    }

    private void navReportBestPerfDev(){
        Intent intent = new Intent(TriagerReportActivity.this, TriagerReportBestPerfDevActivity.class);
        startActivity(intent);
    }

    private void navReportBestPerfRep(){
        Intent intent = new Intent(TriagerReportActivity.this, TriagerReportBestPerfRepActivity.class);
        startActivity(intent);
    }

    public void ClickMenu(View view){
        NavBarActivity.openDrawer(drawerLayout);
    }

    public void ClickLogo(View view){
        NavBarActivity.closeDrawer(drawerLayout);
    }

    public void ClickTriagerHome(View view){
        NavBarActivity.redirectActivity(TriagerReportActivity.this, TriagerHomeActivity.class);
    }

    public void ClickAssignBug(View view){
        NavBarActivity.redirectActivity(TriagerReportActivity.this, TriagerAssignBugActivity.class);
    }

    public void ClickTriagerDiscuss(View view){
        NavBarActivity.redirectActivity(TriagerReportActivity.this, TriagerDiscussionActivity.class);
    }

    public void ClickTriagerAllBug(View view){
        NavBarActivity.redirectActivity(TriagerReportActivity.this, TriagerAllBugActivity.class);
    }

    public void ClickInvalidBug(View view){
        NavBarActivity.redirectActivity(TriagerReportActivity.this, TriagerUpdateDuplicateAndInvalidBugActivity.class);
    }

    public void ClickTriagerCloseReports(View view){
        NavBarActivity.redirectActivity(TriagerReportActivity.this, TriagerCloseReportsActivity.class);
    }

    public void ClickTriagerReport(View view){
        recreate();
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(TriagerReportActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }
}