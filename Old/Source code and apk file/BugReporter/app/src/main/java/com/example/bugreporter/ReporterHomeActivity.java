package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;
import androidx.drawerlayout.widget.DrawerLayout;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;


public class ReporterHomeActivity extends AppCompatActivity {

    private CardView cardView, cardView2, cardView3;
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reporter_home);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);

        cardView = (CardView)findViewById(R.id.cardView);
        cardView2 = (CardView)findViewById(R.id.cardView2);
        cardView3 = (CardView)findViewById(R.id.cardView3);

        cardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navReportFormActivity();
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
    }

    private void navReportFormActivity(){
        Intent i = new Intent(ReporterHomeActivity.this, ReporterReportFormActivity.class);
        startActivity(i);
    }

    private void navDiscussionActivity(){
        Intent in = new Intent(ReporterHomeActivity.this, ReporterDiscussionActivity.class);
        startActivity(in);
    }

    private void navAllBugActivity(){
        Intent intent = new Intent(ReporterHomeActivity.this, ReporterAllBugActivity.class);
        startActivity(intent);
    }

    public void ClickMenu(View view){
        NavBarActivity.openDrawer(drawerLayout);
    }

    public void ClickLogo(View view){
        NavBarActivity.closeDrawer(drawerLayout);
    }

    public void ClickHome(View view){
        recreate();
    }

    public void ClickReportBug(View view){
        NavBarActivity.redirectActivity(ReporterHomeActivity.this, ReporterReportFormActivity.class);
    }

    public void ClickDiscuss(View view){
        NavBarActivity.redirectActivity(ReporterHomeActivity.this, ReporterDiscussionActivity.class);
    }

    public void ClickAllBug(View view){
        NavBarActivity.redirectActivity(ReporterHomeActivity.this, ReporterAllBugActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(ReporterHomeActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }
}