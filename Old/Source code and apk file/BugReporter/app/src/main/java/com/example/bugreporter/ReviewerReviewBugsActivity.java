package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.SearchView;
import android.widget.Spinner;
import android.widget.Toast;

import java.util.ArrayList;

public class ReviewerReviewBugsActivity extends AppCompatActivity {
    //SearchView searchView;
    ListView listView;
    EditText editText;
    Button submit;
    ArrayList<String> list;
    ArrayAdapter adapter;
    EditText editTextSearch;
    ImageView imageView;
    //DatabaseAdapter dbAdapter;
    //BugController bugController;
    ReviewerReviewBugsController reviewerReviewBugsController;
    SearchController searchController;
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reviewer_review_bugs);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);
        listView = (ListView)findViewById(R.id.list_pending_review_bugs);
        editText = (EditText)findViewById(R.id.editTextBugId);
        submit = (Button)findViewById(R.id.button2);
        editTextSearch = (EditText)findViewById(R.id.etSearch);
        imageView = (ImageView)findViewById(R.id.ivSearch);
        reviewerReviewBugsController = new ReviewerReviewBugsController(this);
        searchController = new SearchController(this);
        list = new ArrayList<>();

        viewPendingReviewBugs();

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                updatePendingReviewBugs(editText.getText().toString());
            }
        });

        imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                searchPendingReviewBug(editTextSearch.getText().toString());
            }
        });

    }

    private void viewList(ArrayList<String> list)
    {
        adapter = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
        listView.setAdapter(adapter);
    }

    private void viewPendingReviewBugs(){
        list = reviewerReviewBugsController.getPendingReviewBugs();

        if (list.size() == 0){
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewList(list);
        }
    }

    private void updatePendingReviewBugs(String bugid){
        if(bugid.isEmpty()){
            Message.message(getApplicationContext(), "Please enter bug id.");
        } else {
            long id = reviewerReviewBugsController.updatePendingReviewBugs(bugid);

            if (id <= 0){
                Message.message(getApplicationContext(), "Error. Please try again.");

            } else {
                Message.message(getApplicationContext(), "Updated.");
                editText.setText("");

                adapter.clear();
                viewPendingReviewBugs();
            }
        }
    }

    private void searchPendingReviewBug(String keyword){
        adapter.clear();
        list = searchController.searchPendingReviewBug(keyword);
        if(list.size() == 0) {
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewList(list);
        }
    }

    public void ClickMenu(View view){
        NavBarActivity.openDrawer(drawerLayout);
    }

    public void ClickLogo(View view){
        NavBarActivity.closeDrawer(drawerLayout);
    }

    public void ClickReviewerHome(View view){
        NavBarActivity.redirectActivity(ReviewerReviewBugsActivity.this, ReviewerHomeActivity.class);
    }

    public void ClickReviewerDiscuss(View view){
        NavBarActivity.redirectActivity(ReviewerReviewBugsActivity.this, ReviewerDiscussionActivity.class);
    }

    public void ClickReviewerAllBug(View view){
        NavBarActivity.redirectActivity(ReviewerReviewBugsActivity.this, ReviewerAllBugActivity.class);
    }

    public void ClickReviewerReviewBugs(View view){
        recreate();
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(ReviewerReviewBugsActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }
}