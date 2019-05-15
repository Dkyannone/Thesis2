package com.example.yanno.login;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

public class registerUser extends AppCompatActivity {

    EditText name;
    EditText surname;
    EditText email;
    EditText sport;
    EditText team;
    EditText password;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_user);
        name = (EditText)findViewById(R.id.etName);
        surname = (EditText)findViewById(R.id.etSurname);
        email = (EditText)findViewById(R.id.etEmailr);
        sport = (EditText)findViewById(R.id.etSport);
        team = (EditText)findViewById(R.id.etTeam);
        password = (EditText)findViewById(R.id.etPass);
    }

    public void OnReg(View view) {
        String strName = name.getText().toString();
        String strSurname = surname.getText().toString();
        String strEmail = email.getText().toString();
        String strSport = sport.getText().toString();
        String strTeam = team.getText().toString();
        String strPassword = password.getText().toString();
        String type = "register";

        BackgroundWorker backgroundWorker = new BackgroundWorker(this);
        backgroundWorker.execute(type, strName, strSurname, strEmail, strSport, strTeam, strPassword);

    }
}
