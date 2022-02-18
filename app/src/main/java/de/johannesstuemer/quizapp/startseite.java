package de.johannesstuemer.quizapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class startseite extends AppCompatActivity {
    private Button duellK, spielmodus, schwierigkeit, kategorie, start, back;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_startseite);

        duellK = findViewById(R.id.duellkoenigButton);
        spielmodus = findViewById(R.id.spielmodusButton);
        schwierigkeit = findViewById(R.id.schwierigkeitslisteButton);
        kategorie = findViewById(R.id.FragenkategorieButton);
        start = findViewById(R.id.spielStartenButton);
        back = findViewById(R.id.back_btn);

        duellK.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(startseite.this, DuellTabelle.class);
                startActivity(intent);
                finish();
            }
        });

        spielmodus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(startseite.this, Spielmodus.class);
                startActivity(intent);
                finish();
            }
        });

        schwierigkeit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(startseite.this, Schwierigkeit.class);
                startActivity(intent);
                finish();
            }
        });

        kategorie.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(startseite.this, Kategorie.class);
                startActivity(intent);
                finish();
            }
        });

        start.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(startseite.this, Spiel.class);
                startActivity(intent);
                finish();
            }
        });

        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(startseite.this, Login.class);
                startActivity(intent);
                finish();
            }
        });
    }
}