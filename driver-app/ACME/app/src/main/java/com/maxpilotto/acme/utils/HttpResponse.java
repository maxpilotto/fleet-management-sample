package com.maxpilotto.acme.utils;

/**
 * Project: ACME
 * Created by: Max
 * Date: 27/04/2018 @ 17:15
 * Package: com.maxpilotto.acme.utils
 */
public class HttpResponse{
    private int code;
    private String message;
    private String error;
    private String[] parameters;

    public HttpResponse(int code, String message, String error) {
        this.code = code;
        this.message = message;
        this.error = error;
        this.parameters = null;
    }

    public HttpResponse(int code, String message, String error, String[] parameters) {
        this.code = code;
        this.message = message;
        this.error = error;
        this.parameters = parameters;
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

    public String[] getParameters() {
        return parameters;
    }

    public void setParameters(String[] parameters) {
        this.parameters = parameters;
    }
}