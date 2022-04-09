package com.example.bugreporter;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

public class ReporterReportFormActivity extends AppCompatActivity {
    private EditText bugtitle;
    private EditText bugtype;
    private EditText bugDesc;
    private Button submit;

    ReporterReportFormController reporterReportFormController;
    String userName;
    DrawerLayout drawerLayout;
    SharedPreferences sharedPreferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reporter_report_form);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);

        bugtitle = (EditText)findViewById(R.id.editTextBugTitle);
        bugDesc = (EditText)findViewById(R.id.editTextBugDescription);
        submit = (Button)findViewById(R.id.buttonSubmit);
        userName = getIntent().getStringExtra("username");
        reporterReportFormController = new ReporterReportFormController(this);
        sharedPreferences = getSharedPreferences("myPrefs", MODE_PRIVATE);

        userName = sharedPreferences.getString("uname", null);

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                submitReport(bugtitle.getText().toString(), bugDesc.getText().toString(), userName);
            }
        });

    }

    public void submitReport(String bugtitle, String bugDesc, String username) {
        if (bugtitle.isEmpty()){
            Message.message(getApplicationContext(), "Please enter bug title.");
        } else if (bugDesc.isEmpty()) {
            Message.message(getApplicationContext(), "Please enter bug description.");
        } else {
            long id = reporterReportFormController.insertBug(bugtitle, bugDesc, username);

            if (id <= 0){
                Message.message(getApplicationContext(), "Error. Please try again.");

            } else {
                Message.message(getApplicationContext(), "Bug reported successfully.");

                Intent intent = new Intent(ReporterReportFormActivity.this, ReporterAllBugActivity.class);
                startActivity(intent);
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
        NavBarActivity.redirectActivity(ReporterReportFormActivity.this, ReporterHomeActivity.class);

    }

    public void ClickReportBug(View view){
        recreate();
    }

    public void ClickDiscuss(View view){
        NavBarActivity.redirectActivity(ReporterReportFormActivity.this, ReporterDiscussionActivity.class);
    }

    public void ClickAllBug(View view){
        NavBarActivity.redirectActivity(ReporterReportFormActivity.this, ReporterAllBugActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(ReporterReportFormActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }
}