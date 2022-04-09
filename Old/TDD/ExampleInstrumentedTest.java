package com.example.bugreport;

import android.content.Context;
import android.view.Gravity;

import androidx.test.espresso.ViewAction;
import androidx.test.espresso.action.ViewActions;
import androidx.test.ext.junit.rules.ActivityScenarioRule;
import androidx.test.platform.app.InstrumentationRegistry;
import androidx.test.ext.junit.runners.AndroidJUnit4;
import androidx.test.rule.ActivityTestRule;

import org.junit.Rule;
import org.junit.Test;
import org.junit.runner.RunWith;

import static androidx.test.espresso.Espresso.closeSoftKeyboard;
import static androidx.test.espresso.Espresso.onData;
import static androidx.test.espresso.Espresso.onView;
import static androidx.test.espresso.action.ViewActions.click;
import static androidx.test.espresso.action.ViewActions.typeText;
import static androidx.test.espresso.assertion.ViewAssertions.matches;
import static androidx.test.espresso.matcher.ViewMatchers.hasSibling;
import static androidx.test.espresso.matcher.ViewMatchers.withContentDescription;
import static androidx.test.espresso.matcher.ViewMatchers.withId;
import static androidx.test.espresso.matcher.ViewMatchers.withText;
import static java.lang.Thread.sleep;
import static org.hamcrest.Matchers.allOf;
import static org.hamcrest.Matchers.anything;
import static org.hamcrest.Matchers.instanceOf;
import static org.junit.Assert.*;


/**
 * Instrumented test, which will execute on an Android device.
 *
 * @see <a href="http://d.android.com/tools/testing">Testing documentation</a>
 */
@RunWith(AndroidJUnit4.class)
public class ExampleInstrumentedTest {
    @Rule public ActivityScenarioRule<LoginActivity> activityLogin =
            new ActivityScenarioRule<>(LoginActivity.class);

//    @Rule public ActivityScenarioRule<DeveloperHomeActivity> devHomeActivity =
//            new ActivityScenarioRule<>(DeveloperHomeActivity.class);
//
//    @Rule public ActivityScenarioRule<NavBarActivity> navBarActivity =
//            new ActivityScenarioRule<>(NavBarActivity.class);

//    @Test
//    public void useAppContext() {
//        // Context of the app under test.
//        Context appContext = InstrumentationRegistry.getInstrumentation().getTargetContext();
//        assertEquals("com.example.bugreport", appContext.getPackageName());
//    }

    @Test
    public void reporterLoginPassandLogout() throws InterruptedException {
        onView(withId(R.id.editTextUsername)).perform(typeText("reporter1"));
        onView(withId(R.id.editTextPassword)).perform(typeText("1234"));
        onView(withId(R.id.editTextPassword)).perform(ViewActions.closeSoftKeyboard());
        sleep(1000);

        onView(withId(R.id.buttonLogin)).perform(click());
        sleep(1000);

        // in dev home page
        onView(withId(R.id.openMenu)).perform(click());
        sleep(1000);

        onView(withContentDescription("Logout")).perform(click());
        sleep(1000);

        // application returns back to login page after clicking yes
        onView(withText("Yes")).perform(click());
        sleep(1000);
    }

    @Test
    public void devLoginPassandLogout() throws InterruptedException {
        onView(withId(R.id.editTextUsername)).perform(typeText("developer1"));
        onView(withId(R.id.editTextPassword)).perform(typeText("1234"));
        onView(withId(R.id.editTextPassword)).perform(ViewActions.closeSoftKeyboard());
        sleep(1000);

        onView(withId(R.id.buttonLogin)).perform(click());
        sleep(1000);

        // in dev home page
        onView(withId(R.id.openMenu)).perform(click());
        sleep(1000);

        onView(withContentDescription("Logout")).perform(click());
        sleep(1000);

        // application returns back to login page after clicking yes
        onView(withText("Yes")).perform(click());
        sleep(1000);
    }

    @Test
    public void triagerLoginPassandLogout() throws InterruptedException {
        onView(withId(R.id.editTextUsername)).perform(typeText("triager1"));
        onView(withId(R.id.editTextPassword)).perform(typeText("1234"));
        onView(withId(R.id.editTextPassword)).perform(ViewActions.closeSoftKeyboard());
        sleep(1000);

        onView(withId(R.id.buttonLogin)).perform(click());
        sleep(1000);

        // in dev home page
        onView(withId(R.id.openMenu)).perform(click());
        sleep(1000);

        onView(withContentDescription("Logout")).perform(click());
        sleep(1000);

        // application returns back to login page after clicking yes
        onView(withText("Yes")).perform(click());
        sleep(1000);
    }

    @Test
    public void reviewerLoginPassandLogout() throws InterruptedException {
        onView(withId(R.id.editTextUsername)).perform(typeText("reviewer1"));
        onView(withId(R.id.editTextPassword)).perform(typeText("1234"));
        onView(withId(R.id.editTextPassword)).perform(ViewActions.closeSoftKeyboard());
        sleep(1000);

        onView(withId(R.id.buttonLogin)).perform(click());
        sleep(1000);

        // in dev home page
        onView(withId(R.id.openMenu)).perform(click());
        sleep(1000);

        onView(withContentDescription("Logout")).perform(click());
        sleep(1000);

        // application returns back to login page after clicking yes
        onView(withText("Yes")).perform(click());
        sleep(1000);
    }

    @Test
    public void loginFail() throws InterruptedException {
        // failed login for 5 times
        // first 4 times show Incorrect username or password. Please try again.
        // last time show You have reached the maximum number of attempts.

        // Test 1
        onView(withId(R.id.editTextUsername)).perform(typeText("developer0"));
        onView(withId(R.id.editTextPassword)).perform(typeText("1230"), ViewActions.closeSoftKeyboard());
        onView(withId(R.id.buttonLogin)).perform(click());
        onView(withId(R.id.textViewIncorrect)).check(matches(withText("Incorrect username or password. Please try again.")));
        sleep(1000);

        // Test 2
        onView(withId(R.id.editTextUsername)).perform(ViewActions.clearText(), typeText("dev1"));
        onView(withId(R.id.editTextPassword)).perform(ViewActions.clearText(), typeText("1234"), ViewActions.closeSoftKeyboard());
        onView(withId(R.id.buttonLogin)).perform(click());
        onView(withId(R.id.textViewIncorrect)).check(matches(withText("Incorrect username or password. Please try again.")));
        sleep(1000);

        // Test 3
        onView(withId(R.id.editTextUsername)).perform(ViewActions.clearText(), typeText("triager2"));
        onView(withId(R.id.editTextPassword)).perform(ViewActions.clearText(), typeText("1230"), ViewActions.closeSoftKeyboard());
        onView(withId(R.id.buttonLogin)).perform(click());
        onView(withId(R.id.textViewIncorrect)).check(matches(withText("Incorrect username or password. Please try again.")));
        sleep(1000);

        // Test 4
        onView(withId(R.id.editTextUsername)).perform(ViewActions.clearText(), typeText("reporter3"));
        onView(withId(R.id.editTextPassword)).perform(ViewActions.clearText(), typeText("1230"), ViewActions.closeSoftKeyboard());
        onView(withId(R.id.buttonLogin)).perform(click());
        onView(withId(R.id.textViewIncorrect)).check(matches(withText("Incorrect username or password. Please try again.")));
        sleep(1000);

        // Test 5 - different error message
        onView(withId(R.id.editTextUsername)).perform(ViewActions.clearText(), typeText("reviewer4"));
        onView(withId(R.id.editTextPassword)).perform(ViewActions.clearText(), typeText("1230"), ViewActions.closeSoftKeyboard());
        onView(withId(R.id.buttonLogin)).perform(click());
        onView(withId(R.id.textViewIncorrect)).check(matches(withText("You have reached the maximum number of attempts.")));
        sleep(1000);
    }
}