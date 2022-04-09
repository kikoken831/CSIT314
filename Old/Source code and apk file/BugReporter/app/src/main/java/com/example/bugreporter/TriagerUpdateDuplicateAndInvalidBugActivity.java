package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.SearchView;
import android.widget.Spinner;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;

public class TriagerUpdateDuplicateAndInvalidBugActivity extends AppCompatActivity {
    ListView listView;
    EditText editText;
    Button submit;
    Spinner spinner;
    ArrayList<String> list;
    ArrayAdapter adapter;
    EditText editTextSearch;
    ImageView imageView;
    TriagerInvalidBugController triagerInvalidBugController;
    TriagerDuplicateBugController triagerDuplicateBugController;
    SearchController searchController;
    DrawerLayout drawerLayout;

    String statusSelected;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_triager_update_bug_status);

        listView = (ListView)findViewById(R.id.list_unresolved_bugs);
        editText = (EditText)findViewById(R.id.editTextBugId);
        submit = (Button)findViewById(R.id.button2);
        spinner = (Spinner)findViewById(R.id.spinnerStatus);
        editTextSearch = (EditText)findViewById(R.id.etSearch);
        imageView = (ImageView)findViewById(R.id.ivSearch);
        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);
        triagerInvalidBugController = new TriagerInvalidBugController(this);
        triagerDuplicateBugController = new TriagerDuplicateBugController(this);
        searchController = new SearchController(this);
        list = new ArrayList<>();

        List<String> status = new ArrayList<>();
        status.add(0, "Select status from the list");
        status.add("invalid");
        status.add("duplicated");
        ArrayAdapter<String> arrayAdapt = new ArrayAdapter(this, android.R.layout.simple_list_item_1, status);
        arrayAdapt.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner.setAdapter(arrayAdapt);
        spinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                if (parent.getItemAtPosition(position).equals("Select status from the list")){
                } else {
                    statusSelected = parent.getItemAtPosition(position).toString();
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });

        viewUnresolvedBug();

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                updateInvalidBug(editText.getText().toString(), statusSelected);
            }
        });

        imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                searchUnresolvedBug(editTextSearch.getText().toString());
            }
        });
    }

    private void viewList(ArrayList<String> list)
    {
        adapter = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
        listView.setAdapter(adapter);
    }

    private void viewUnresolvedBug(){
        list = triagerInvalidBugController.getUnresolvedBugs();

        if (list.size() == 0){
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewList(list);
        }
    }

    private void updateInvalidBug(String bugid, String status){
        if(bugid.isEmpty()){
            Message.message(getApplicationContext(), "Please enter bug id.");
        } else if (!(status.equals("invalid")||status.equals("duplicated"))){
            Message.message(getApplicationContext(), "Please select a valid status.");
        } else {
            long id = 0;

            if (status.equals("invalid")){
                id = triagerInvalidBugController.updateInvalidBug(bugid);
            } else if (status.equals("duplicated")){
                id = triagerDuplicateBugController.updateDuplicatedBug(bugid);
            }

            if (id <= 0){
                Message.message(getApplicationContext(), "Error. Please try again.");

            } else {
                Message.message(getApplicationContext(), "Updated.");
                editText.setText("");

                adapter.clear();
                viewUnresolvedBug();
            }
        }
    }

    private void searchUnresolvedBug(String keyword){
        adapter.clear();
        list = searchController.searchUnresolvedBug(keyword);
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
        NavBarActivity.redirectActivity(TriagerUpdateDuplicateAndInvalidBugActivity.this, TriagerHomeActivity.class);
    }

    public void ClickAssignBug(View view){
        NavBarActivity.redirectActivity(TriagerUpdateDuplicateAndInvalidBugActivity.this, TriagerAssignBugActivity.class);
    }

    public void ClickInvalidBug(View view){
        recreate();
    }

    public void ClickTriagerDiscuss(View view){
        NavBarActivity.redirectActivity(TriagerUpdateDuplicateAndInvalidBugActivity.this, TriagerDiscussionActivity.class);
    }

    public void ClickTriagerAllBug(View view){
        NavBarActivity.redirectActivity(TriagerUpdateDuplicateAndInvalidBugActivity.this, TriagerAllBugActivity.class);
    }

    public void ClickTriagerReport(View view){
        NavBarActivity.redirectActivity(TriagerUpdateDuplicateAndInvalidBugActivity.this, TriagerReportActivity.class);
    }

    public void ClickTriagerCloseReports(View view){
        NavBarActivity.redirectActivity(TriagerUpdateDuplicateAndInvalidBugActivity.this, TriagerCloseReportsActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(TriagerUpdateDuplicateAndInvalidBugActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }

}