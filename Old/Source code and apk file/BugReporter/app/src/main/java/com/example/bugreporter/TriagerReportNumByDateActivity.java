package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.app.DatePickerDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ListView;
import android.text.InputType;
import android.widget.Toast;

import java.math.RoundingMode;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.Calendar;

public class TriagerReportNumByDateActivity extends AppCompatActivity {
    DatePickerDialog picker1, picker2;
    EditText dateFrom, dateTo;
    Button btnView;
    ListView listReported, listResolved;
    ArrayList<String> list1, list2;
    ArrayAdapter adapter1, adapter2;
    TriagerReportNumByDateController triagerReportNumByDateController;
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_triager_report_num_by_date);

        drawerLayout = (DrawerLayout)findViewById(R.id.draw_layout);

        final DecimalFormat mFormat= new DecimalFormat("00");
        mFormat.setRoundingMode(RoundingMode.DOWN);

        dateFrom = (EditText)findViewById(R.id.editTextDateFrom);
        dateFrom.setInputType(InputType.TYPE_NULL);
        dateFrom.setOnClickListener((new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Calendar cldr = Calendar.getInstance();
                int day = cldr.get(Calendar.DAY_OF_MONTH);
                int month = cldr.get(Calendar.MONTH);
                int year = cldr.get(Calendar.YEAR);
                // date picker dialog
                picker1 = new DatePickerDialog(TriagerReportNumByDateActivity.this,
                        new DatePickerDialog.OnDateSetListener() {
                            @Override
                            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                                dateFrom.setText(year + "-" + mFormat.format(monthOfYear + 1) + "-" + mFormat.format(dayOfMonth));
                            }
                        }, year, month, day);
                picker1.show();
            }
        }));

        dateTo = (EditText)findViewById(R.id.editTextDateTo);
        dateTo.setInputType(InputType.TYPE_NULL);
        dateTo.setOnClickListener((new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Calendar cldr = Calendar.getInstance();
                int day = cldr.get(Calendar.DAY_OF_MONTH);
                int month = cldr.get(Calendar.MONTH);
                int year = cldr.get(Calendar.YEAR);
                // date picker dialog
                picker2 = new DatePickerDialog(TriagerReportNumByDateActivity.this,
                        new DatePickerDialog.OnDateSetListener() {
                            @Override
                            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                                dateTo.setText(year + "-" + mFormat.format(monthOfYear + 1) + "-" + mFormat.format(dayOfMonth));
                            }
                        }, year, month, day);
                picker2.show();
            }
        }));

        listReported = (ListView)findViewById(R.id.list_reported);
        listResolved = (ListView)findViewById(R.id.list_resolved);
        triagerReportNumByDateController = new TriagerReportNumByDateController(this);
        list1 = new ArrayList<>();
        list2 = new ArrayList<>();

        btnView = (Button)findViewById(R.id.buttonView);
        btnView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                viewReported(dateFrom.getText().toString(), dateTo.getText().toString());
                viewResolved(dateFrom.getText().toString(), dateTo.getText().toString());
            }
        });
    }

    private void viewListReported(ArrayList<String> list)
    {
        adapter1 = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
        listReported.setAdapter(adapter1);
    }

    private void viewListResolved(ArrayList<String> list)
    {
        adapter2 = new ArrayAdapter(this, android.R.layout.simple_list_item_1, list);
        listResolved.setAdapter(adapter2);
    }

    private void viewReported(String startDate, String endDate){
        list1 = triagerReportNumByDateController.getNumberOfBugsReported(startDate, endDate);

        if (list1.size() == 0){
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewListReported(list1);

        }
    }

    private void viewResolved(String startDate, String endDate){
       list2 = triagerReportNumByDateController.getNumberofBugsResolved(startDate, endDate);

        if (list2.size() == 0){
            Toast.makeText(this, "No record to show.", Toast.LENGTH_SHORT).show();
        } else {
            viewListResolved(list2);
        }
    }


    public void ClickMenu(View view){
        NavBarActivity.openDrawer(drawerLayout);
    }

    public void ClickLogo(View view){
        NavBarActivity.closeDrawer(drawerLayout);
    }

    public void ClickTriagerHome(View view){
        NavBarActivity.redirectActivity(TriagerReportNumByDateActivity.this, TriagerHomeActivity.class);
    }

    public void ClickAssignBug(View view){
        NavBarActivity.redirectActivity(TriagerReportNumByDateActivity.this, TriagerAssignBugActivity.class);
    }

    public void ClickTriagerDiscuss(View view){
        NavBarActivity.redirectActivity(TriagerReportNumByDateActivity.this, TriagerDiscussionActivity.class);
    }

    public void ClickTriagerAllBug(View view){
        NavBarActivity.redirectActivity(TriagerReportNumByDateActivity.this, TriagerAllBugActivity.class);
    }

    public void ClickTriagerReport(View view){
        NavBarActivity.redirectActivity(TriagerReportNumByDateActivity.this, TriagerReportActivity.class);
    }

    public void ClickInvalidBug(View view){
        NavBarActivity.redirectActivity(TriagerReportNumByDateActivity.this, TriagerUpdateDuplicateAndInvalidBugActivity.class);
    }

    public void ClickTriagerCloseReports(View view){
        NavBarActivity.redirectActivity(TriagerReportNumByDateActivity.this, TriagerCloseReportsActivity.class);
    }

    public void ClickLogout(View view){
        NavBarActivity.logout(TriagerReportNumByDateActivity.this);
    }

    @Override
    protected void onPause() {
        super.onPause();

        NavBarActivity.closeDrawer(drawerLayout);
    }
}