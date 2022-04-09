package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;
import androidx.drawerlayout.widget.DrawerLayout;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class ReviewerHomeActivity extends AppCompatActivity {
    private CardView cardView, cardView2, cardView3;
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reviewer_home);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);

        cardView = (CardView)findViewById(R.id.cardView);
        cardView2 = (CardView)findViewById(R.id.cardView2);
        cardView3 = (CardView)findViewById(R.id.cardView3);

        cardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                navAllBugActivity();
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
                navReviewBugsActivity();
            }
        });


    }

    private void navDiscussionActivity(){
        Intent in = new Intent(ReviewerHomeActivity.this, ReviewerDiscussionActivity.class);
        startActivity(in);
    }

    private void navAllBugActivity(){
        Intent intent = new Intent(ReviewerHomeActivity.this, ReviewerAllBugActivity.class);
        startActivity(intent);
    }

    private void navReviewBugsActivity(){
        Intent intent = new Intent(ReviewerHomeActivity.this, ReviewerReviewBugsActivity.class);
        startActivity(intent);
    }

    public void ClickMenu(View view){
        NavBarActivity.openDrawer(drawerLayout);
    }

    public void ClickLogo(View view){
        NavBarActivity.closeDrawer(drawerLayout);
    }

    public void ClickReviewerHome(View view){
        recreate();
    }

    public void ClickReviewerDiscuss(View view){
        NavBarActivity.redirectActivity(ReviewerHomeActivity.this, ReviewerDiscussionActivity.class);
    }

    public void ClickReviewerAllBug(View view){
        NavBarActivity.redirectActivity(ReviewerHomeActivity.this, ReviewerAllBugActivity.class);
    }

    public void ClickReviewerReviewBugs(View view){
        NavBarActivity.redirectActivity(ReviewerHomeActivity.this,ReviewerReviewBugsActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(ReviewerHomeActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }

}