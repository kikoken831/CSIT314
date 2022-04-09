package com.example.bugreporter;

import android.content.Context;

public class LoginController {
    private User user;

    public LoginController(Context context)
    {
        user = new User(context);
    }

    public Class<?> check(String username, String password)
    {
        int count = user.checkUser(username, password);
        String r = "";
        Class<?> cls = null;

        if(count == 1)
        {
            r = user.getRole(username, password);
        }

        switch(r)
        {
            case "reporter":
                cls = ReporterHomeActivity.class;
                break;

            case "developer":
                cls = DeveloperHomeActivity.class;
                break;

            case "triager":
                cls = TriagerHomeActivity.class;
                break;

            case "reviewer":
                cls = ReviewerHomeActivity.class;
                break;

            default:
                break;

        }

        return cls;
    }
}
