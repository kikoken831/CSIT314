package com.example.bugreporter;

import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;
import java.util.ArrayList;

public class ReviewerAllBugActivity extends AppCompatActivity {
    EditText editText;
    ImageView imageView;
    ListView listView;
    ArrayList<String> list;
    ArrayAdapter adapter;
    ReviewerAllBugController reviewerAllBugController;
    SearchController searchController;

    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reviewer_all_bug);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);
        listView = (ListView)findViewById(R.id.list_bugs);
        editText = (EditText)findViewById(R.id.etSearch);
        imageView = (ImageView)findViewById(R.id.ivSearch);
        reviewerAllBugController = new ReviewerAllBugController(this);
        searchController = new SearchController(this);
        list = new ArrayList<>();

        viewBug();

        imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                searchBug(editText.getText().toString());
            }
        });

    }

    private void viewList(ArrayList<String> list)
    {
        adapter = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
        listView.setAdapter(adapter);
    }

    private void viewBug(){
        list = reviewerAllBugController.getBug();
        if(list.size() == 0) {
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewList(list);
        }

    }

    private void searchBug(String keyword){
        adapter.clear();
        list = searchController.searchBug(keyword);
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
        NavBarActivity.redirectActivity(ReviewerAllBugActivity.this, ReviewerHomeActivity.class);
    }

    public void ClickReviewerDiscuss(View view){
        NavBarActivity.redirectActivity(ReviewerAllBugActivity.this, ReviewerDiscussionActivity.class);
    }

    public void ClickReviewerAllBug(View view){
        recreate();
    }

    public void ClickReviewerReviewBugs(View view){
        NavBarActivity.redirectActivity(ReviewerAllBugActivity.this,ReviewerReviewBugsActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(ReviewerAllBugActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }

}