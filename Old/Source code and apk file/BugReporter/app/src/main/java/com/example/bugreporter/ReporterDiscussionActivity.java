package com.example.bugreporter;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import java.util.ArrayList;

public class ReporterDiscussionActivity extends AppCompatActivity {
    DrawerLayout drawerLayout;
    ListView listView;
    ArrayList<String> list;
    ArrayAdapter adapter;
    ReporterDiscussionController reporterDiscussionController;
    SharedPreferences sharedPreferences;

    private EditText bugid;
    private EditText comment;
    private Button viewComment;
    private Button submitComment;

    public String username;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reporter_discussion);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);
        bugid = (EditText)findViewById(R.id.editTextBugID);
        comment = (EditText)findViewById(R.id.editTextComment);
        viewComment = (Button)findViewById(R.id.buttonViewComment);
        submitComment = (Button)findViewById(R.id.buttonSubmit);
        listView = (ListView)findViewById(R.id.list_bug_comments);
        reporterDiscussionController = new ReporterDiscussionController(this);
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
        list = reporterDiscussionController.getBugForum(bugid);

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


            long id = reporterDiscussionController.insertComment(username, bugID, cmt);

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

    public void ClickHome(View view){
        NavBarActivity.redirectActivity(ReporterDiscussionActivity.this, ReporterHomeActivity.class);
    }

    public void ClickReportBug(View view){
        NavBarActivity.redirectActivity(ReporterDiscussionActivity.this, ReporterReportFormActivity.class);
    }

    public void ClickDiscuss(View view){
        recreate();
    }

    public void ClickAllBug(View view){
        NavBarActivity.redirectActivity(ReporterDiscussionActivity.this, ReporterAllBugActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(ReporterDiscussionActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }
}