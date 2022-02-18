package de.johannesstuemer.quizapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    private Button login, register;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        login = findViewById(R.id.login_btn);
        register = findViewById(R.id.register_btn);

        login.setOnClickListener(this);
        register.setOnClickListener(this);
    }

    public void register(View view){
        Intent intent = new Intent(this, Register.class);
        startActivity(intent);
        finish();
    }

    public void login(View view){
        Intent intent = new Intent(this, Login.class);
        startActivity(intent);
        finish();
    }

    @Override
    public void onClick(View v) {
        if(v == login){
            login(v);
        }else{
            register(v);
        }
    }
}