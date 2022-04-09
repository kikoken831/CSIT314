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
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;

public class DeveloperDiscussionActivity extends AppCompatActivity {
    DrawerLayout drawerLayout;
    ListView listView;
    ArrayList<String> list;
    ArrayAdapter adapter;
    DeveloperDiscussionController developerDiscussionController;
    SharedPreferences sharedPreferences;

    private EditText bugid;
    private EditText comment;
    private Button viewComment;
    private Button submitComment;

    public String username;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_developer_discussion);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);
        bugid = (EditText)findViewById(R.id.editTextBugID);
        comment = (EditText)findViewById(R.id.editTextComment);
        viewComment = (Button)findViewById(R.id.buttonViewComment);
        submitComment = (Button)findViewById(R.id.buttonSubmit);
        listView = (ListView)findViewById(R.id.list_bug_comments);
        developerDiscussionController = new DeveloperDiscussionController(this);
        list = new ArrayList<>();
        sharedPreferences = getSharedPreferences("myPrefs", MODE_PRIVATE);

        username = sharedPreferences.getString("uname", null);

        viewComment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                viewBugForum(bugid.getText().toString());
            }
        });

        submitComment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                insertComment(username, bugid.getText().toString(), comment.getText().toString());
            }
        });


    }
    private void viewList(ArrayList<String> list)
    {
        adapter = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
        listView.setAdapter(adapter);
    }

    public void viewBugForum(String bugid){
        list = developerDiscussionController.getBugForum(bugid);

        if (list.size() == 0){
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewList(list);
        }
    }

    public void insertComment(String username, String bugID, String cmt){
        if(cmt.isEmpty()){
            Message.message(getApplicationContext(), "Please enter comment.");
        } else {
            long id = developerDiscussionController.insertComment(username, bugID, cmt);

            if (id <= 0){
                Message.message(getApplicationContext(), "Error. Please try again.");

            } else {
                Message.message(getApplicationContext(), "Comment Successfully.");
                comment.setText("");

                adapter.clear();
                viewBugForum(bugID);
            }
        }
    }

    public void ClickMenu(View view){
        NavBarActivity.openDrawer(drawerLayout);
    }

    public void ClickLogo(View view){
        NavBarActivity.closeDrawer(drawerLayout);
    }

    public void ClickDeveloperHome(View view){
        NavBarActivity.redirectActivity(DeveloperDiscussionActivity.this, DeveloperHomeActivity.class);
    }

    public void ClickMyBug(View view){
        NavBarActivity.redirectActivity(DeveloperDiscussionActivity.this, DeveloperMyBugsActivity.class);
    }

    public void ClickDevDiscuss(View view){
        recreate();
    }

    public void ClickDevAllBug(View view){
        NavBarActivity.redirectActivity(DeveloperDiscussionActivity.this, DeveloperAllBugActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(DeveloperDiscussionActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }
}