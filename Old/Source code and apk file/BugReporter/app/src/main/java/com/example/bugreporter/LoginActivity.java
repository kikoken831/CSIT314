package com.example.bugreporter;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.database.Cursor;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class LoginActivity extends AppCompatActivity {
    private EditText username;
    private EditText password;
    private Button login;
    private TextView incorrect;

    private LoginController loginController;
    private int counter = 5;

    public static final String myPref = "myPrefs";
    public static final String uname = "uname";

    SharedPreferences sharedPreferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        username = (EditText)findViewById(R.id.editTextUsername);
        password = (EditText)findViewById((R.id.editTextPassword));
        login = (Button)findViewById(R.id.buttonLogin);
        incorrect = (TextView)findViewById(R.id.textViewIncorrect);

        sharedPreferences = getSharedPreferences(myPref, Context.MODE_PRIVATE);

        loginController = new LoginController(this);

        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                validate(username.getText().toString(), password.getText().toString());

                String u = username.getText().toString();

                SharedPreferences.Editor editor = sharedPreferences.edit();

                editor.putString(uname, u);
                editor.commit();
            }
        });

    }

    private void validate (String userName, String userPassword)
    {
        Class cls = loginController.check(userName, userPassword);

        if(cls != null)
        {
            Intent intent = new Intent(LoginActivity.this, cls);
            startActivity(intent);
            finish();
        }else{
            counter--;

            incorrect.setText("Incorrect username or password. Please try again.");

            if (counter == 0)
            {
                login.setEnabled(false);
                incorrect.setText("You have reached the maximum number of attempts.");
            }
        }
    }
}