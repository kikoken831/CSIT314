package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;
import androidx.drawerlayout.widget.DrawerLayout;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class TriagerHomeActivity extends AppCompatActivity {
    private CardView cardView, cardView2, cardView3, cardView4, cardView5, cardView6;
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_triager_home);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);

        cardView = (CardView)findViewById(R.id.cardView);
        cardView2 = (CardView)findViewById(R.id.cardView2);
        cardView3 = (CardView)findViewById(R.id.cardView3);
        cardView4 = (CardView)findViewById(R.id.cardView4);
        cardView5 = (CardView)findViewById(R.id.cardView5);
        cardView6 = (CardView)findViewById(R.id.cardView6);

        cardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navAssignBugActivity();
            }
        });

        cardView2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navDiscussionActivity();
            }
        });

        cardView3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navAllBugActivity();
            }
        });

        cardView4.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navInvalidBug();
            }
        });

        cardView5.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navReports();
            }
        });

        cardView6.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navCloseReports();
            }
        });
    }

    private void navAssignBugActivity(){
        Intent i = new Intent(TriagerHomeActivity.this, TriagerAssignBugActivity.class);
        startActivity(i);
    }

    private void navDiscussionActivity(){
        Intent in = new Intent(TriagerHomeActivity.this, TriagerDiscussionActivity.class);
        startActivity(in);
    }

    private void navAllBugActivity(){
        Intent intent = new Intent(TriagerHomeActivity.this, TriagerAllBugActivity.class);
        startActivity(intent);
    }

    private void navInvalidBug(){
        Intent intent = new Intent(TriagerHomeActivity.this, TriagerUpdateDuplicateAndInvalidBugActivity.class);
        startActivity(intent);
    }

    private void navReports(){
        Intent intent = new Intent(TriagerHomeActivity.this, TriagerReportActivity.class);
        startActivity(intent);
    }

    private void navCloseReports(){
        Intent intent = new Intent(TriagerHomeActivity.this, TriagerCloseReportsActivity.class);
        startActivity(intent);
    }

    public void ClickMenu(View view){
        NavBarActivity.openDrawer(drawerLayout);
    }

    public void ClickLogo(View view){
        NavBarActivity.closeDrawer(drawerLayout);
    }

    public void ClickTriagerHome(View view){
        recreate();
    }

    public void ClickAssignBug(View view){
        NavBarActivity.redirectActivity(TriagerHomeActivity.this, TriagerAssignBugActivity.class);
    }

    public void ClickTriagerDiscuss(View view){
        NavBarActivity.redirectActivity(TriagerHomeActivity.this, TriagerDiscussionActivity.class);
    }

    public void ClickTriagerAllBug(View view){
        NavBarActivity.redirectActivity(TriagerHomeActivity.this, TriagerAllBugActivity.class);
    }

    public void ClickInvalidBug(View view){
        NavBarActivity.redirectActivity(TriagerHomeActivity.this, TriagerUpdateDuplicateAndInvalidBugActivity.class);
    }

    public void ClickTriagerCloseReports(View view){
        NavBarActivity.redirectActivity(TriagerHomeActivity.this, TriagerCloseReportsActivity.class);
    }

    public void ClickTriagerReport(View view){
        NavBarActivity.redirectActivity(TriagerHomeActivity.this, TriagerReportActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(TriagerHomeActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }
}