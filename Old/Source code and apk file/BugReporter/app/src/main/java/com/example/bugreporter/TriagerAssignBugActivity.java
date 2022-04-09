package com.example.bugreporter;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import java.util.ArrayList;

public class TriagerAssignBugActivity extends AppCompatActivity {
    ListView listView1, listView2;
    EditText editText1, editText2;
    EditText editTextSearch1, editTextSearch2;
    ImageView imageView1, imageView2;
    Button submit;
    ArrayList<String> listBug, listDeveloper;
    ArrayAdapter adapter1, adapter2;
    TriagerAssignBugController triagerAssignBugController;
    SearchController searchController;
    SharedPreferences sharedPreferences;
    DrawerLayout drawerLayout;

    public String username;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_triager_assign_bug);

        listView1 = (ListView)findViewById(R.id.list_bugs);
        listView2 = (ListView)findViewById(R.id.list_developers);
        editText1 = (EditText)findViewById(R.id.editTextBugid);
        editText2 = (EditText)findViewById(R.id.editTextDeveloperUsername);
        submit = (Button)findViewById(R.id.buttonSubmit);
        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);
        editTextSearch1 = (EditText)findViewById(R.id.etSearch1);
        editTextSearch2 = (EditText)findViewById(R.id.etSearch2);
        imageView1 = (ImageView)findViewById(R.id.ivSearch1);
        imageView2 = (ImageView)findViewById(R.id.ivSearch2);
        triagerAssignBugController = new TriagerAssignBugController(this);
        searchController = new SearchController(this);
        listBug = new ArrayList<>();
        listDeveloper = new ArrayList<>();

        sharedPreferences = getSharedPreferences("myPrefs", MODE_PRIVATE);

        username = sharedPreferences.getString("uname", null);

        viewUnassignedBug();
        viewDevelopers();

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                assignBug(editText1.getText().toString(), editText2.getText().toString(),username);
            }
        });

        imageView1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                searchUnassignedBug(editTextSearch1.getText().toString());
            }
        });

        imageView2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                searchDeveloper(editTextSearch2.getText().toString());
            }
        });
    }

    private void viewList1(ArrayList<String> list)
    {
        adapter1 = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
        listView1.setAdapter(adapter1);
    }

    private void viewList2(ArrayList<String> list)
    {
        adapter2 = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
        listView2.setAdapter(adapter2);
    }


    private void viewUnassignedBug(){
        listBug = triagerAssignBugController.getUnassignedBug();

        if (listBug.size() == 0){
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewList1(listBug);
        }
    }

    private void viewDevelopers(){
        listDeveloper = triagerAssignBugController.getDevelopers();

        if (listDeveloper.size() == 0){
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
           viewList2(listDeveloper);
        }
    }

    private void assignBug(String bugid, String developerUsername, String allocatedby){
        if(bugid.isEmpty()){
            Message.message(getApplicationContext(), "Please enter bug id.");
        } else if(developerUsername.isEmpty()){
            Message.message(getApplicationContext(), "Please enter developer's user id.");
        } else {
            long id;

            id = triagerAssignBugController.assign(bugid, developerUsername, allocatedby);


            if (id <= 0){
                Message.message(getApplicationContext(), "Error. Please try again.");

            } else {
                Message.message(getApplicationContext(), "Assigned.");
                editText1.setText("");
                editText2.setText("");

                adapter1.clear();
                viewUnassignedBug();
            }
        }
    }

    private void searchUnassignedBug(String keyword){
        adapter1.clear();
        listBug = searchController.searchUnassignedBug(keyword);
        if(listBug.size() == 0) {
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewList1(listBug);
        }
    }

    private void searchDeveloper(String keyword){
        adapter2.clear();
        listDeveloper = searchController.searchDeveloper(keyword);
        if(listDeveloper.size() == 0) {
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewList2(listDeveloper);
        }
    }

    public void ClickMenu(View view){
        NavBarActivity.openDrawer(drawerLayout);
    }

    public void ClickLogo(View view){
        NavBarActivity.closeDrawer(drawerLayout);
    }

    public void ClickTriagerHome(View view){
        NavBarActivity.redirectActivity(TriagerAssignBugActivity.this, TriagerHomeActivity.class);
    }

    public void ClickAssignBug(View view){
        recreate();
    }

    public void ClickTriagerDiscuss(View view){
        NavBarActivity.redirectActivity(TriagerAssignBugActivity.this, TriagerDiscussionActivity.class);
    }

    public void ClickInvalidBug(View view){
        NavBarActivity.redirectActivity(TriagerAssignBugActivity.this, TriagerUpdateDuplicateAndInvalidBugActivity.class);
    }

    public void ClickTriagerAllBug(View view){
        NavBarActivity.redirectActivity(TriagerAssignBugActivity.this, TriagerAllBugActivity.class);
    }

    public void ClickTriagerCloseReports(View view){
        NavBarActivity.redirectActivity(TriagerAssignBugActivity.this, TriagerCloseReportsActivity.class);
    }

    public void ClickTriagerReport(View view){
        NavBarActivity.redirectActivity(TriagerAssignBugActivity.this, TriagerReportActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(TriagerAssignBugActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }

}