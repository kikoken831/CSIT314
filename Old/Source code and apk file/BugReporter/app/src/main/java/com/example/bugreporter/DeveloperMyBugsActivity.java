package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.content.SharedPreferences;
import android.database.Cursor;
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

public class DeveloperMyBugsActivity extends AppCompatActivity {
    ListView listView;
    EditText editText;
    EditText editTextSearch;
    ImageView imageView;
    Button submit;
    ArrayList<String> list;
    ArrayAdapter adapter;
    DeveloperMyBugsController developerMyBugsController;
    SearchController searchController;
    SharedPreferences sharedPreferences;
    DrawerLayout drawerLayout;

    public String username;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_developer_my_bugs);

        listView = (ListView)findViewById(R.id.list_my_bugs);
        editText = (EditText)findViewById(R.id.editTextBugId);
        submit = (Button)findViewById(R.id.button2);
        editTextSearch = (EditText)findViewById(R.id.etSearch);
        imageView = (ImageView)findViewById(R.id.ivSearch);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);

        developerMyBugsController = new DeveloperMyBugsController(this);
        searchController = new SearchController(this);
        list = new ArrayList<>();

        sharedPreferences = getSharedPreferences("myPrefs", MODE_PRIVATE);

        username = sharedPreferences.getString("uname", null);

        viewMyBugs(username);

        imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                searchMyBug(editTextSearch.getText().toString(), username);
            }
        });

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                pendingReview(editText.getText().toString());
            }
        });
    }
    private void viewList(ArrayList<String> list)
    {
        adapter = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
        listView.setAdapter(adapter);
    }

    private void viewMyBugs(String username){
        list = developerMyBugsController.getMyBugs(username);

        if (list.size() == 0){
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            /*adapter = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
            listView.setAdapter(adapter);*/
            viewList(list);
        }
    }

    private void pendingReview(String bugid){
        if(bugid.isEmpty()){
            Message.message(getApplicationContext(), "Please enter bug id.");
        } else {
            long id = developerMyBugsController.updatePending(bugid, username);

            if (id <= 0){
                Message.message(getApplicationContext(), "Error. Please try again." );

            } else {
                Message.message(getApplicationContext(), "Updated.");
                editText.setText("");

                adapter.clear();
                viewMyBugs(username);
            }
        }
    }

    private void searchMyBug(String keyword, String username){
        adapter.clear();
        list = searchController.searchMyBug(keyword, username);
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

    public void ClickDeveloperHome(View view){
        NavBarActivity.redirectActivity(DeveloperMyBugsActivity.this, DeveloperHomeActivity.class);
    }

    public void ClickMyBug(View view){
        recreate();
    }

    public void ClickDevDiscuss(View view){
        NavBarActivity.redirectActivity(DeveloperMyBugsActivity.this, DeveloperDiscussionActivity.class);
    }

    public void ClickDevAllBug(View view){
        NavBarActivity.redirectActivity(DeveloperMyBugsActivity.this, DeveloperAllBugActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(DeveloperMyBugsActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }
}