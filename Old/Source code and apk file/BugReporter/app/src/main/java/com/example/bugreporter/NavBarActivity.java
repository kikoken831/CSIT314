package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.view.View;

public class NavBarActivity extends AppCompatActivity {
    private static SharedPreferences sharedPreferences;
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_nav_bar);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);


    }
    public void ClickMenu(View view){
        openDrawer(drawerLayout);
    }

    public static void openDrawer(DrawerLayout drawerLayout){
        drawerLayout.openDrawer(GravityCompat.START);

    }

    public void ClickLogo(View view){
        closeDrawer(drawerLayout);
    }

    public static void closeDrawer(DrawerLayout drawerLayout){
        if (drawerLayout.isDrawerOpen(GravityCompat.START)){
            drawerLayout.closeDrawer(GravityCompat.START);
        }
    }

    public void ClickHome(View view){
        recreate();
    }

    public void ClickDeveloperHome(View view){
        recreate();
    }

    public void ClickTriagerHome(View view){
        recreate();
    }

    public void ClickReviewerHome(View view){
        recreate();
    }

    public void ClickReportBug(View view){
        redirectActivity(NavBarActivity.this, ReporterReportFormActivity.class);
    }

    public void ClickMyBug(View view){
        redirectActivity(NavBarActivity.this, DeveloperMyBugsActivity.class);
    }

    public void ClickAssignBug(View view){
        redirectActivity(NavBarActivity.this, TriagerAssignBugActivity.class);
    }

    public void ClickInvalidBug(View view){
        redirectActivity(NavBarActivity.this, TriagerUpdateDuplicateAndInvalidBugActivity.class);
    }

    public void ClickReviewerReviewBugs(View view){
        redirectActivity(NavBarActivity.this, ReviewerReviewBugsActivity.class);
    }

    public void ClickTriagerReport(View view){
        redirectActivity(NavBarActivity.this, TriagerReportActivity.class);
    }

    public void ClickTriagerCloseReports(View view) {
        redirectActivity(NavBarActivity.this, TriagerCloseReportsActivity.class);
    }

    public void ClickAllBug(View view){
        redirectActivity(NavBarActivity.this, ReporterAllBugActivity.class);
    }

    public void ClickDevAllBug(View view){
        redirectActivity(NavBarActivity.this, DeveloperAllBugActivity.class);
    }

    public void ClickTriagerAllBug(View view){
        redirectActivity(NavBarActivity.this, TriagerAllBugActivity.class);
    }

    public void ClickReviewerAllBug(View view){
        redirectActivity(NavBarActivity.this, ReviewerAllBugActivity.class);
    }

    public void ClickDiscuss(View view){
        redirectActivity(NavBarActivity.this, ReporterDiscussionActivity.class);
    }

    public void ClickDevDiscuss(View view){
        redirectActivity(NavBarActivity.this, DeveloperDiscussionActivity.class);
    }

    public void ClickTriagerDiscuss(View view){
        redirectActivity(NavBarActivity.this, TriagerDiscussionActivity.class);
    }

    public void ClickReviewerDiscuss(View view){
        redirectActivity(NavBarActivity.this, ReviewerDiscussionActivity.class);
    }

    public void ClickLogout(View view){
        logout(this);
    }

    public static void logout(final Activity activity){
        AlertDialog.Builder builder = new AlertDialog.Builder(activity);

        builder.setTitle("Logout");

        builder.setMessage("Are you sure you want to logout?");

        //Positive yes button
        builder.setPositiveButton("Yes", new DialogInterface.OnClickListener() {

            @Override
            public void onClick(DialogInterface dialog, int which) {
                //finsih activity
                activity.finishAffinity();

                SharedPreferences sharedPreferences = PreferenceManager.getDefaultSharedPreferences(activity);
                SharedPreferences.Editor editor = sharedPreferences.edit();
                editor.clear();
                editor.commit();

                //return to login page
                Intent intent = new Intent(activity, LoginActivity.class);
                activity.startActivity(intent);


            }
        });
        //Negative no button
        builder.setNegativeButton("No", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                //Dismiss dialog
                dialog.dismiss();
            }
        });

        builder.show();
    }

    public static void redirectActivity(Activity activity, Class aClass){
        Intent intent = new Intent(activity, aClass);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);

        activity.startActivity(intent);
    }

    @Override
    protected void onPause() {
        super.onPause();

        closeDrawer(drawerLayout);
    }
}
