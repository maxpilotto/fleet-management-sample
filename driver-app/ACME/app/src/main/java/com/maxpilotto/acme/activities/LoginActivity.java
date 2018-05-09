package com.maxpilotto.acme.activities;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;

import com.maxpilotto.acme.R;
import com.maxpilotto.acme.tasks.RequestDriverInfo;
import com.maxpilotto.acme.utils.HttpResponse;

import org.json.JSONObject;

public class LoginActivity extends AppCompatActivity {
    public static final int RESULT_OK = 15;
    public static final int RESULT_ERROR = 20;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        findViewById(R.id.sendLogin).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                final String username = ((EditText)findViewById(R.id.username)).getText().toString();
                final String password = ((EditText)findViewById(R.id.password)).getText().toString();

                RequestDriverInfo request = new RequestDriverInfo(username, password, new RequestDriverInfo.RequestListener() {
                    @Override
                    public void onReceive(HttpResponse response) {
                        if (response.getCode() == HttpResponse.CODE_OK){
                            if (response.getObject() != null){
                                Intent data = new Intent();

                                try {
                                    JSONObject obj = response.getObject();
                                    data.putExtra("shipmentId", obj.getInt("shipmentId"));
                                    data.putExtra("name", obj.getString("name"));
                                    data.putExtra("surname", obj.getString("surname"));
                                    data.putExtra("username", username);
                                    data.putExtra("password", password);
                                    data.putExtra("destination", obj.getString("destination"));
                                }catch (Exception e){

                                }

                                setResult(RESULT_OK,data);
                                finish();
                            }
                        }

                        setResult(RESULT_ERROR);
                        finish();
                    }
                });
                request.execute();
            }
        });
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        setResult(RESULT_ERROR);
        finish();
    }
}
