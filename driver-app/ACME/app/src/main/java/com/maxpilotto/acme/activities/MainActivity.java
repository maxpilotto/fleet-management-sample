package com.maxpilotto.acme.activities;

import android.content.Intent;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import com.maxpilotto.acme.R;
import com.maxpilotto.acme.tasks.RequestDriverInfo;
import com.maxpilotto.acme.utils.HttpResponse;

import org.json.JSONException;

public class MainActivity extends AppCompatActivity {
    private static final int REQUEST_LOGIN_CODE = 10;
    private SharedPreferences preferences;
    private int shipmentId = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        preferences = PreferenceManager.getDefaultSharedPreferences(this);

        preferences = PreferenceManager.getDefaultSharedPreferences(this);
        if (!preferences.getBoolean("logged", false)) {
            startActivityForResult(new Intent(this, LoginActivity.class), REQUEST_LOGIN_CODE);
        } else {
            RequestDriverInfo request = new RequestDriverInfo(preferences.getString("username", ""), preferences.getString("password", ""), new RequestDriverInfo.RequestListener() {
                @Override
                public void onReceive(HttpResponse response) {
                    if (response.getCode() == HttpResponse.CODE_OK) {
                        try {
                            shipmentId = response.getObject().getInt("shipmentId");

                            ((TextView) findViewById(R.id.user)).setText(String.format("Hello %s",preferences.getString("username","")));
                            ((TextView) findViewById(R.id.destination)).setText(String.format("Current destination: %s",response.getObject().getString("destination")));
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                }
            });
            request.execute();
        }
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == REQUEST_LOGIN_CODE) {
            if (resultCode == LoginActivity.RESULT_OK) {
                preferences.edit().putBoolean("logged", true).apply();
                preferences.edit().putString("username", data.getStringExtra("username")).apply();
                preferences.edit().putString("password", data.getStringExtra("password")).apply();
                shipmentId = data.getIntExtra("shipmentId", 0);

                ((TextView) findViewById(R.id.user)).setText(String.format("Hello %s",data.getStringExtra("username")));
                ((TextView) findViewById(R.id.destination)).setText(String.format("Current destination: %s",data.getStringExtra("destination")));
            } else {
                Toast.makeText(this, "Wrong username or password", Toast.LENGTH_SHORT).show();
                startActivityForResult(new Intent(this, LoginActivity.class), REQUEST_LOGIN_CODE);
            }

        }
    }
}
