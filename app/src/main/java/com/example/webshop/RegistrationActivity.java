package com.example.webshop;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;

public class RegistrationActivity extends AppCompatActivity {

    private static final String PREF_KEY = MainActivity.class.getPackage().toString();
    private static final String LOG_TAG = RegistrationActivity.class.getName();

    private static final int SECRET_KEY = 99;

    EditText usernameEditText;
    EditText nameEditText;
    EditText passwordEditText;
    EditText emailEditText;

    private SharedPreferences preferences;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registration);

//        Bundle bundle = getIntent().getExtras();
//        int secret_key = bundle.getInt("SECRET_KEY");
        int secret_key = getIntent().getIntExtra("SECRET_KEY", 0);


        if(secret_key != 99){
            finish();
        }

        usernameEditText = findViewById(R.id.usernameEdittext);
        nameEditText = findViewById(R.id.nameEdittext);
        passwordEditText = findViewById(R.id.passwordTextPassword);
        emailEditText = findViewById(R.id.editTextEmail);

        preferences = getSharedPreferences(PREF_KEY, MODE_PRIVATE);
        String username = preferences.getString("userName", "");
        String password = preferences.getString("password", "");

        usernameEditText.setText(username);
        passwordEditText.setText(password);

        Log.i(LOG_TAG, "onCreate");
    }
    public void signup(View view) {
        String name = nameEditText.getText().toString();
        String userName = usernameEditText.getText().toString();
        String password = passwordEditText.getText().toString();
        String email = emailEditText.getText().toString();

        Log.i(LOG_TAG, "Regisztrált: " + userName + ",name: "+ name+ ", jelszo: " + password + ", email: "+ email);
        shopping();
    }

    public void shopping(){
        Intent intent = new Intent(this, ShopListActivity.class);
        intent.putExtra("SECRET_KEY", SECRET_KEY);
        startActivity(intent);
    }

    public void cancel(View view) {
        finish();
    }

    @Override
    protected void onStart() {
        super.onStart();
        Log.i(LOG_TAG, "onStart");
    }

    @Override
    protected void onStop() {
        super.onStop();
        Log.i(LOG_TAG, "onStop");
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        Log.i(LOG_TAG, "onDestroy");
    }

    @Override
    protected void onPause() {
        super.onPause();
        Log.i(LOG_TAG, "onPause");
    }

    @Override
    protected void onResume() {
        super.onResume();
        Log.i(LOG_TAG, "onResume");
    }
    @Override
    protected void onRestart() {
        super.onRestart();
        Log.i(LOG_TAG, "onRestart");
    }
}