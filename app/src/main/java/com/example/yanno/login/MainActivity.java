package com.example.yanno.login;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

public class MainActivity extends AppCompatActivity {
    EditText emailEt, passwordEt;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        emailEt = (EditText)findViewById(R.id.etEmail);
        passwordEt = (EditText)findViewById(R.id.etPassword);

    }

    public void onLogin(View view) {
        String email = emailEt.getText().toString();
        String password = passwordEt.getText().toString();
        String type = "login";

        BackgroundWorker backgroundWorker = new BackgroundWorker(this);
        backgroundWorker.execute(type, email, password);
        //execute get info
        //backgroundWorker.execute(type2, email, password);
        //if email and password match, log user in
        startHomeApp(email, password, "email", "pass");
        //startActivity(new Intent(this,Home.class));



    }

    public void OpenReg(View view) {
        startActivity(new Intent(this,registerUser.class));
        //log user in
        //if email and password match, log user in

        //else alert dialog not matching username and pass
    }

    public void startHomeApp(String email, String password, String emailCheck, String passwordCheck){
        if(email.equals(emailCheck) && password.equals(passwordCheck)){
            startActivity(new Intent(this,Home.class));
        }
    }
}
