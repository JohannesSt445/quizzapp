package de.johannesstuemer.quizapp;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class Login extends AppCompatActivity implements View.OnClickListener {

    private EditText email_et, passwort_et;
    private Button back;
    private String email, passwort;
    private String URL = "http://127.0.0.1/php/quizzapp_mysql/login.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        email = passwort = "";
        email_et = findViewById(R.id.email_et2);
        passwort_et = findViewById(R.id.passwort_et2);
        back = findViewById(R.id.back_btn);

        back.setOnClickListener(this);
    }

    public void login(View view){
        email = email_et.getText().toString().trim();
        passwort = passwort_et.getText().toString().trim();
        if(!email.equals("") && !passwort.equals("")){
            StringRequest stringRequest = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    if (response.equals("success")) {
                        Intent intent = new Intent(Login.this, startseite.class);
                        startActivity(intent);
                        finish();
                    } else if (response.equals("failure")) {
                        Toast.makeText(Login.this, "Ungültiger Login Id/Passwort", Toast.LENGTH_LONG).show();
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(Login.this, error.toString().trim(), Toast.LENGTH_LONG).show();
                }
            }){
                @Nullable
                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> data = new HashMap<>();
                    data.put("email", email);
                    data.put("passwort", passwort);
                    return data;
                }
            };
            RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
            requestQueue.add(stringRequest);
        }
        else{
            Toast.makeText(this, "Felder müssen ausgefüllt werden!", Toast.LENGTH_LONG).show();
        }
    }

    public void register(View view){
        Intent intent = new Intent(this, Register.class);
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