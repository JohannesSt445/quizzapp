package de.johannesstuemer.quizapp;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class Register extends AppCompatActivity implements View.OnClickListener {
    private EditText username_et, email_et, passwort_et, passwort_wdh_et;
    private TextView status_tv;
    private Button register_btn, back;
    private String URL = "http://quizzapp.chickenkiller.com/quizzapp/backend/api.php";
    private String name, email, passwort, passwort_wdh;
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        username_et = findViewById(R.id.User_et2);
        email_et = findViewById(R.id.email_et2);
        passwort_et = findViewById(R.id.passwort_et2);
        passwort_wdh_et = findViewById(R.id.passwortwdh_et);
        status_tv = findViewById(R.id.status_tv);
        register_btn = findViewById(R.id.register_btn);
        back = findViewById(R.id.back_btn);
        name = email = passwort = passwort_wdh = "";

        back.setOnClickListener(this);
    }

    public void register(View view){
        name = username_et.getText().toString().trim();
        email = email_et.getText().toString().trim();
        passwort = passwort_et.getText().toString().trim();
        passwort_wdh = passwort_wdh_et.getText().toString().trim();
        if(!passwort.equals(passwort_wdh)){
            Toast.makeText(this, "Passwörter stimmen nicht überein", Toast.LENGTH_LONG).show();
        }
        else if(!name.equals("") && !email.equals("") && !passwort.equals("")){
            StringRequest stringRequest = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    if (response.equals("Registriert!")) {
                        status_tv.setText("Erfolgreich registriert");
                        register_btn.setClickable(false);
                    } else if (response.equals("Registrierung fehlgeschlagen!") || response.equals("Benutzername oder E-Mail existieren bereits")) {
                        status_tv.setText("Etwas ist schief gelaufen!");
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(getApplicationContext(), error.toString().trim(), Toast.LENGTH_LONG).show();
                }
            }){
                @Nullable
                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> data = new HashMap<>();
                    data.put("name", name);
                    data.put("email", email);
                    data.put("passwort", passwort);
                    return data;
                }
            };
            RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
            requestQueue.add(stringRequest);
        }
    }

    public void login(View view){
        Intent intent = new Intent(this, Login.class);
        startActivity(intent);
        finish();
    }

    public void back(View v){
        Intent intent = new Intent(this, MainActivity.class);
        startActivity(intent);
        finish();
    }

    @Override
    public void onClick(View v) {
        back(v);
    }
}
