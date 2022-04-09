package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;
import androidx.drawerlayout.widget.DrawerLayout;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class DeveloperHomeActivity extends AppCompatActivity {

    private CardView cardView, cardView2, cardView3;
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_developer_home);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);

        cardView = (CardView)findViewById(R.id.cardView);
        cardView2 = (CardView)findViewById(R.id.cardView2);
        cardView3 = (CardView)findViewById(R.id.cardView3);

        cardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navMyBugsActivity();
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

    private void navMyBugsActivity(){
        Intent i = new Intent(DeveloperHomeActivity.this, DeveloperMyBugsActivity.class);
        startActivity(i);
    }

    private void navDiscussionActivity(){
        Intent in = new Intent(DeveloperHomeActivity.this, DeveloperDiscussionActivity.class);
        startActivity(in);
    }

    private void navAllBugActivity(){
        Intent intent = new Intent(DeveloperHomeActivity.this, DeveloperAllBugActivity.class);
        startActivity(intent);
    }

    public void ClickMenu(View view){
        NavBarActivity.openDrawer(drawerLayout);
    }

    public void ClickLogo(View view){
        NavBarActivity.closeDrawer(drawerLayout);
    }

    public void ClickDeveloperHome(View view){
        recreate();
    }

    public void ClickMyBug(View view){
        NavBarActivity.redirectActivity(DeveloperHomeActivity.this, DeveloperMyBugsActivity.class);
    }

    public void ClickDevDiscuss(View view){
        NavBarActivity.redirectActivity(DeveloperHomeActivity.this, DeveloperDiscussionActivity.class);
    }

    public void ClickDevAllBug(View view){
        NavBarActivity.redirectActivity(DeveloperHomeActivity.this, DeveloperAllBugActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(DeveloperHomeActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }
}