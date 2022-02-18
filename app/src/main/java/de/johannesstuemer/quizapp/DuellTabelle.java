package de.johannesstuemer.quizapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class DuellTabelle extends AppCompatActivity implements View.OnClickListener {
    private Button back;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_duell_tabelle);

        back = findViewById(R.id.back_btn);

        back.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        Intent intent = new Intent(DuellTabelle.this, startseite.class);
        startActivity(intent);
        finish();
    }
}