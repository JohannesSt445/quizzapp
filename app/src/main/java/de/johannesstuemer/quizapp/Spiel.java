package de.johannesstuemer.quizapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class Spiel extends AppCompatActivity implements View.OnClickListener {
    private Button back;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_spiel);
        back = findViewById(R.id.back_btn);

        back.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        Intent intent = new Intent(Spiel.this, startseite.class);
        startActivity(intent);
        finish();
    }
}