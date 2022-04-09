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
import android.widget.Toast;

import java.util.ArrayList;

public class TriagerCloseReportsActivity extends AppCompatActivity {
    ListView listView;
    EditText editText;
    Button submit;
    ArrayList<String> list;
    ArrayAdapter adapter;
    EditText editTextSearch;
    ImageView imageView;
    TriagerCloseReportsController triagerCloseReportsController;
    SearchController searchController;
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_triager_close_reports);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);

        listView = (ListView)findViewById(R.id.list_reviewed_bugs);
        editText = (EditText)findViewById(R.id.editTextBugId);
        submit = (Button)findViewById(R.id.button2);
        editTextSearch = (EditText)findViewById(R.id.etSearch);
        imageView = (ImageView)findViewById(R.id.ivSearch);
        triagerCloseReportsController = new TriagerCloseReportsController(this);
        searchController = new SearchController(this);
        list = new ArrayList<>();

        viewReviewedBugs();

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                closeBugReports(editText.getText().toString());
            }
        });

        imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                searchReviewedBug(editTextSearch.getText().toString());
            }
        });
    }

    private void viewList(ArrayList<String> list)
    {
        adapter = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
        listView.setAdapter(adapter);
    }

    private void viewReviewedBugs(){
        list = triagerCloseReportsController.getReviewedBugs();

        if (list.size() == 0){
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewList(list);
        }
    }

    private void closeBugReports(String bugid) {
        if (bugid.isEmpty()) {
            Message.message(getApplicationContext(), "Please enter bug id.");
        } else {
            long id = triagerCloseReportsController.closeBugReports(bugid);

            if (id <= 0) {
                Message.message(getApplicationContext(), "Error. Please try again.");

            } else {
                Message.message(getApplicationContext(), "Updated.");
                editText.setText("");

                adapter.clear();
                viewReviewedBugs();
            }
        }
    }

    private void searchReviewedBug(String keyword){
        adapter.clear();
        list = searchController.searchReviewedBug(keyword);
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

    public void ClickTriagerHome(View view){
        NavBarActivity.redirectActivity(TriagerCloseReportsActivity.this, TriagerHomeActivity.class);
    }

    public void ClickAssignBug(View view){
        NavBarActivity.redirectActivity(TriagerCloseReportsActivity.this, TriagerAssignBugActivity.class);
    }

    public void ClickTriagerDiscuss(View view){
        NavBarActivity.redirectActivity(TriagerCloseReportsActivity.this, TriagerDiscussionActivity.class);
    }

    public void ClickTriagerCloseReports(View view){
        recreate();
    }

    public void ClickTriagerAllBug(View view){
        NavBarActivity.redirectActivity(TriagerCloseReportsActivity.this, TriagerAllBugActivity.class);
    }

    public void ClickTriagerReport(View view){
        NavBarActivity.redirectActivity(TriagerCloseReportsActivity.this, TriagerReportActivity.class);
    }

    public void ClickInvalidBug(View view){
        NavBarActivity.redirectActivity(TriagerCloseReportsActivity.this, TriagerUpdateDuplicateAndInvalidBugActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(TriagerCloseReportsActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }
}