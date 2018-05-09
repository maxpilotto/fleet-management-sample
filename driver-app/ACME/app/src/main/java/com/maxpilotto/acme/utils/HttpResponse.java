package com.maxpilotto.acme.utils;

import org.json.JSONObject;

/**
 * Project: ACME
 * Created by: Max
 * Date: 27/04/2018 @ 17:15
 * Package: com.maxpilotto.acme.utils
 */
public class HttpResponse{
    public static final int CODE_OK = 200;
    public static final int CODE_NO_AUTH = 400;

    private int code;
    private String message;
    private String error;
    private JSONObject object;

    public HttpResponse(int code, String message, String error) {
        this.code = code;
        this.message = message;
        this.error = error;
        this.object = null;
    }

    public HttpResponse(int code, String message, String error, JSONObject object) {
        this.code = code;
        this.message = message;
        this.error = error;
        this.object = object;
    }

    public int getCode() {
        return code;
    }

    public void setCode(int code) {
        this.code = code;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public String getError() {
        return error;
    }

    public void setError(String error) {
        this.error = error;
    }

    public JSONObject getObject() {
        return object;
    }

    public void setObject(JSONObject object) {
        this.object = object;
    }
}