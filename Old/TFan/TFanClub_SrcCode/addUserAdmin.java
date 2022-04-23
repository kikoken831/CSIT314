package tFanClubProject;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JButton;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JTabbedPane;
import javax.swing.JSpinner;
import javax.swing.SpinnerListModel;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import javax.swing.JComboBox;
import javax.swing.DefaultComboBoxModel;
import net.miginfocom.swing.MigLayout;
import javax.swing.SwingConstants;
import java.awt.GridBagLayout;
import java.awt.GridBagConstraints;
import java.awt.Insets;
import javax.swing.GroupLayout;
import javax.swing.GroupLayout.Alignment;
import javax.swing.JTextField;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import javax.swing.JPasswordField;
import java.awt.Color;
import java.beans.PropertyChangeListener;
import java.beans.PropertyChangeEvent;
import javax.swing.JFormattedTextField;
import java.awt.event.FocusAdapter;
import java.awt.event.FocusEvent;
import java.awt.event.ComponentAdapter;
import java.awt.event.ComponentEvent;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;

public class addUserAdmin extends JFrame {
	

	// For the confirm button to know which method and SQL statement to run  
	int whichPanel = 1;
	// Know the update comboBox selected value, for username onType 
	int updateComboBoxValue = 0;
	
	private JPanel contentPane;
	private JTextField textFieldUsernameAdd;
	private JTextField textFieldFirstNameAdd;
	private JTextField textFieldLastNameAdd;
	private JPasswordField passwordFieldAdd;
	private JTextField textFieldDOB;
	private JTextField textFieldEmail;
	private JTextField textFieldPatientID;
	private JTextField textFieldUsernameUpdate;
	private JTextField textFieldFNameUpdate;
	private JTextField textFieldLNameUpdate;
	private JTextField textFieldDobUpdate;
	private JTextField textFieldEmailUpdate;
	private JTextField textFieldPatientIdUpdate;
	private JPasswordField passwordFieldUpdate;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					String username = null;
					addUserAdmin frame = new addUserAdmin(username);
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
		
	}

	/**
	 * Create the frame.
	 */
	public addUserAdmin(String username) {
		//The username is passed here so that when the user goes back to homepage we know 
		//who this user is
		String accountUsername = username;
		

		
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 646, 376);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		
		JTabbedPane tabbedPane = new JTabbedPane(JTabbedPane.TOP);
		contentPane.setLayout(new MigLayout("", "[593px]", "[285px][23px][23px]"));
		contentPane.add(tabbedPane, "cell 0 0,grow");
		
		JPanel panelAdd = new JPanel();
		panelAdd.addComponentListener(new ComponentAdapter() {
			@Override
			public void componentShown(ComponentEvent e) {
				whichPanel = 1;
			}
		});

		
				tabbedPane.addTab("Add", null, panelAdd, null);
				panelAdd.setLayout(new MigLayout("", "[][][][][][][grow][][grow]", "[][][][][][][]"));
				
				JLabel lblUserType = new JLabel("User Type : ");
				panelAdd.add(lblUserType, "cell 5 1,alignx trailing");
				
				JLabel lblUsername = new JLabel("Username : ");
				panelAdd.add(lblUsername, "cell 5 2,alignx trailing");
				
				textFieldUsernameAdd = new JTextField();
				panelAdd.add(textFieldUsernameAdd, "cell 6 2,growx");
				textFieldUsernameAdd.setColumns(10);
				
				JLabel lblDOB = new JLabel("Date of birth : ");
				panelAdd.add(lblDOB, "cell 7 2,alignx trailing");
				
				textFieldDOB = new JTextField();
				textFieldDOB.addFocusListener(new FocusAdapter() {
					@Override
					//If the field is empty, put back the hint
					public void focusLost(FocusEvent e) {
						if (textFieldDOB.getText().trim().equals("")) {
							textFieldDOB.setText("DDMMYYYY");
						}
					}
				});
				textFieldDOB.addMouseListener(new MouseAdapter() {
					@Override
					//Hint disappears when clicked on
					public void mouseClicked(MouseEvent e) {
						if (textFieldDOB.getText().equals("DDMMYYYY")){
								textFieldDOB.setText(null);
						}
					}
				});
				textFieldDOB.setForeground(Color.BLACK);
				textFieldDOB.setText("DDMMYYYY");
				panelAdd.add(textFieldDOB, "cell 8 2,growx");
				textFieldDOB.setColumns(10);
				
				JLabel lblPassword = new JLabel("Password : ");
				panelAdd.add(lblPassword, "cell 5 3,alignx trailing");
				
				passwordFieldAdd = new JPasswordField();
				panelAdd.add(passwordFieldAdd, "cell 6 3,growx");
				
				JLabel lblEmail = new JLabel("Email : ");
				panelAdd.add(lblEmail, "cell 7 3,alignx trailing");
				
				textFieldEmail = new JTextField();
				panelAdd.add(textFieldEmail, "cell 8 3,growx");
				textFieldEmail.setColumns(10);
				
				JLabel lblFirstName = new JLabel("First Name : ");
				panelAdd.add(lblFirstName, "cell 5 4,alignx trailing");
				
				textFieldFirstNameAdd = new JTextField();
				panelAdd.add(textFieldFirstNameAdd, "cell 6 4,growx");
				textFieldFirstNameAdd.setColumns(10);
				
				JLabel lblPatientID = new JLabel("PatientID : ");
				lblPatientID.setEnabled(false);
				panelAdd.add(lblPatientID, "cell 7 4,alignx trailing");
				
				textFieldPatientID = new JTextField();
				textFieldPatientID.setEnabled(false);
				panelAdd.add(textFieldPatientID, "cell 8 4,growx");
				textFieldPatientID.setColumns(10);
				
				JLabel lblLastName = new JLabel("Last Name : ");
				panelAdd.add(lblLastName, "cell 5 5,alignx trailing");
				
				textFieldLastNameAdd = new JTextField();
				panelAdd.add(textFieldLastNameAdd, "cell 6 5,growx");
				textFieldLastNameAdd.setColumns(10);
				
				JLabel lblErrorMessage = new JLabel("");
				lblErrorMessage.setForeground(Color.RED);
				panelAdd.add(lblErrorMessage, "cell 6 6");
				
				JComboBox comboBoxAdd = new JComboBox();
				comboBoxAdd.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						int userType = comboBoxAdd.getSelectedIndex();
						switch(userType) {
							case 0:
								lblDOB.setEnabled(false);
								lblEmail.setEnabled(false);
								textFieldDOB.setEnabled(false);
								textFieldEmail.setEnabled(false);
								lblFirstName.setText("First Name : ");
								lblLastName.setText("Last Name : ");
								lblPatientID.setEnabled(false);
								textFieldPatientID.setEnabled(false);
								textFieldLastNameAdd.setEnabled(true);
								break;
							case 1:
								lblDOB.setEnabled(false);
								lblEmail.setEnabled(false);
								textFieldDOB.setEnabled(false);
								textFieldEmail.setEnabled(false);
								lblFirstName.setText("First Name : ");
								lblLastName.setText("Last Name : ");
								lblPatientID.setEnabled(true);
								textFieldPatientID.setEnabled(true);
								textFieldLastNameAdd.setEnabled(true);
								break;
							case 2:
								lblDOB.setEnabled(true);
								lblEmail.setEnabled(true);
								textFieldDOB.setEnabled(true);
								textFieldEmail.setEnabled(true);
								lblFirstName.setText("First Name : ");
								lblLastName.setText("Last Name : ");
								lblPatientID.setEnabled(false);
								textFieldPatientID.setEnabled(false);
								textFieldLastNameAdd.setEnabled(true);
								break;
							case 3:
								lblDOB.setEnabled(false);
								lblEmail.setEnabled(false);
								textFieldDOB.setEnabled(false);
								textFieldEmail.setEnabled(false);
								lblFirstName.setText("Pharmacist Name : ");
								lblLastName.setEnabled(false);
								lblPatientID.setEnabled(false);
								textFieldPatientID.setEnabled(false);
								textFieldLastNameAdd.setEnabled(false);
								break;
						}
					}
				});
				comboBoxAdd.setModel(new DefaultComboBoxModel(new String[] {"Admin", "Doctor", "Patient", "Pharmacist"}));
				comboBoxAdd.setSelectedIndex(0);
				panelAdd.add(comboBoxAdd, "cell 6 1,alignx right");
		
		JPanel panelUpdate = new JPanel();
		panelUpdate.addComponentListener(new ComponentAdapter() {
			@Override
			public void componentShown(ComponentEvent e) {
				whichPanel = 2;
			}
		});

		tabbedPane.addTab("View/Update", null, panelUpdate, null);
		panelUpdate.setLayout(new MigLayout("", "[][][][][][][grow][grow][grow][]", "[][][][][][][]"));
		
		JLabel lblSelectUser = new JLabel("User Type : ");
		panelUpdate.add(lblSelectUser, "cell 5 1,alignx trailing");
		
	
		JLabel lblUsernameUpdate = new JLabel("Username : ");
		panelUpdate.add(lblUsernameUpdate, "cell 5 2,alignx trailing");
		
		textFieldUsernameUpdate = new JTextField();
		textFieldUsernameUpdate.addKeyListener(new KeyAdapter() {
			@Override
			public void keyReleased(KeyEvent e) {
				retrieveUserAcc();
			}
		});

		panelUpdate.add(textFieldUsernameUpdate, "flowx,cell 6 2,growx");
		textFieldUsernameUpdate.setColumns(10);
		
		JLabel lblDOBUpdate = new JLabel("Date Of Birth : ");
		lblDOBUpdate.setEnabled(false);
		panelUpdate.add(lblDOBUpdate, "cell 7 2,alignx trailing");
		
		textFieldDobUpdate = new JTextField();
		textFieldDobUpdate.setEnabled(false);
		panelUpdate.add(textFieldDobUpdate, "cell 8 2 2 1,growx");
		textFieldDobUpdate.setColumns(10);
		
		JLabel lblPasswordUpdate = new JLabel("Password : ");
		panelUpdate.add(lblPasswordUpdate, "cell 5 3,alignx trailing");
		
		passwordFieldUpdate = new JPasswordField();
		passwordFieldUpdate.setEnabled(false);
		panelUpdate.add(passwordFieldUpdate, "cell 6 3,growx");
		
		JLabel lblEmailUpdate = new JLabel("Email : ");
		lblEmailUpdate.setEnabled(false);
		panelUpdate.add(lblEmailUpdate, "cell 7 3,alignx trailing");
		
		textFieldEmailUpdate = new JTextField();
		textFieldEmailUpdate.setEnabled(false);
		panelUpdate.add(textFieldEmailUpdate, "cell 8 3 2 1,growx");
		textFieldEmailUpdate.setColumns(10);
		
		JLabel lblFNameUpdate = new JLabel("First Name : ");
		panelUpdate.add(lblFNameUpdate, "cell 5 4,alignx trailing");
		
		textFieldFNameUpdate = new JTextField();
		textFieldFNameUpdate.setEnabled(false);
		panelUpdate.add(textFieldFNameUpdate, "cell 6 4,growx");
		textFieldFNameUpdate.setColumns(10);
		
		JLabel lblPatientIDUpdate = new JLabel("Patient ID : ");
		lblPatientIDUpdate.setEnabled(false);
		panelUpdate.add(lblPatientIDUpdate, "cell 7 4,alignx trailing");
		
		textFieldPatientIdUpdate = new JTextField();
		textFieldPatientIdUpdate.setEnabled(false);
		panelUpdate.add(textFieldPatientIdUpdate, "cell 8 4 2 1,growx");
		textFieldPatientIdUpdate.setColumns(10);
		
		JLabel lblLNameUpdate = new JLabel("Last Name : ");
		panelUpdate.add(lblLNameUpdate, "cell 5 5,alignx trailing");
		
		textFieldLNameUpdate = new JTextField();
		textFieldLNameUpdate.setEnabled(false);
		panelUpdate.add(textFieldLNameUpdate, "cell 6 5,growx");
		textFieldLNameUpdate.setColumns(10);
		
		JLabel lblUpdateMessage = new JLabel("");
		lblUpdateMessage.setForeground(Color.RED);
		panelUpdate.add(lblUpdateMessage, "cell 6 6");
		
		//The combo box in update
		//The combo box in update
		//The combo box in update
		JComboBox comboBoxUpdate = new JComboBox();
		comboBoxUpdate.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				//Updates the value whenever combo box is used
				updateComboBoxValue = comboBoxUpdate.getSelectedIndex();
				retrieveUserAcc();
				if (comboBoxUpdate.getSelectedIndex() == 3) {
					lblFNameUpdate.setText("Pharmacist Name : ");
				} else {
					lblFNameUpdate.setText("First Name : ");
					lblLNameUpdate.setText("Last Name : ");
				}
				
				if (updateComboBoxValue == 0) {
					lblDOBUpdate.setEnabled(false);
					lblEmailUpdate.setEnabled(false);
					lblPatientIDUpdate.setEnabled(false);
					lblLNameUpdate.setEnabled(true);
				}
				else if (updateComboBoxValue == 1) {
					lblDOBUpdate.setEnabled(false);
					lblEmailUpdate.setEnabled(false);
					lblPatientIDUpdate.setEnabled(true);
					lblLNameUpdate.setEnabled(true);
				}
				else if (updateComboBoxValue == 2) {
					lblDOBUpdate.setEnabled(true);
					lblEmailUpdate.setEnabled(true);
					lblPatientIDUpdate.setEnabled(false);
					lblLNameUpdate.setEnabled(true);
				}
				else if (updateComboBoxValue == 3) {
					lblDOBUpdate.setEnabled(false);
					lblEmailUpdate.setEnabled(false);
					lblPatientIDUpdate.setEnabled(false);
					lblLNameUpdate.setEnabled(false);
				}
			}
		});
		
		comboBoxUpdate.setModel(new DefaultComboBoxModel(new String[] {"Admin", "Doctor", "Patient", "Pharamacist"}));
		panelUpdate.add(comboBoxUpdate, "cell 6 1,alignx right");
		
		//Back button to return to homepage
		JButton btnBack = new JButton("Back");
		btnBack.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JFrame homepage = new homePageAdmin(accountUsername);
				homepage.setVisible(true);
				dispose();
			}
		});
		contentPane.add(btnBack, "flowx,cell 0 1,alignx right");
		
		
		//Confirm button
		JButton btnConfirm = new JButton("Confirm");
		btnConfirm.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				
				//Checks if it gets info from Panel Add Or Update
				if (whichPanel == 1) {
				lblErrorMessage.setText("");
				
				int userType = comboBoxAdd.getSelectedIndex();
				String username = textFieldUsernameAdd.getText();
				char[] password = passwordFieldAdd.getPassword();
				String fName = textFieldFirstNameAdd.getText();
				String lName = textFieldLastNameAdd.getText();
				String DOB = textFieldDOB.getText();
				String email = textFieldEmail.getText();
				
				if(checkNull(username, password, fName) == true) {
					lblErrorMessage.setText("Please key in all required fields");
				}
				
				else {
					
					addUserAdminController adminCon = new addUserAdminController();
					
				switch(userType) {
				
				//Add admin
				case 0:
					if(lName.isBlank()) {
						lblUpdateMessage.setText("Please key in all required fields");
						break;
					}
					else if(adminCon.addUserAdmin(username, password, fName, lName) == true) {
						lblErrorMessage.setText("Success!");
						successReset();
						break;
					}
					
				//Add doctor
				case 1:
					int patientID = 0;
					//Checks if a number is entered
					try {
						patientID = Integer.parseInt(textFieldPatientID.getText());
					} catch(NumberFormatException r) {
						lblErrorMessage.setText("Please enter patient ID");
						break;
					}
					
					if(lName.isBlank()) {
						lblUpdateMessage.setText("Please key in all required fields");
						break;
					}
					else if(adminCon.addUserDoctor(username, password, fName, lName, patientID) == true) {
						lblErrorMessage.setText("Success!");
						successReset();
						break;
					} 
					else {
						break;
					}
					
				//Add patient
				case 2:
					//Check if dob and email textboxes are filled
					if (checkPatientInfo(DOB,email) == true) {
						lblErrorMessage.setText("Please enter DOB & email");
						break;
					}
					//Check if DOB is following the correct format by checking length of string
					else if(DOB.length() != 8) {
						lblErrorMessage.setText("DOB needs to be in DDMMYYYY format");
						break;
					}
					
					else if(lName.isBlank()) {
						lblUpdateMessage.setText("Please key in all required fields");
						break;
					}
					else {
						//Check if its all integers
						try {
							int tryDOB = Integer.parseInt(textFieldDOB.getText());
						} catch(NumberFormatException r) {
							lblErrorMessage.setText("Please enter DOB in numerals");
							break;
						}
					}
					
					if(adminCon.addUserPatient(username, password, fName, lName, DOB, email)) {
						lblErrorMessage.setText("Success!");
						successReset();
						break;
					}
					else {
						break;
					}
					
				//Add pharmacist
				case 3:
					if(adminCon.addUserPharmacist(username, password, fName)) {
						lblErrorMessage.setText("Success!");
						successReset();
						break;
					}
					else {
						break;
					}
				}
				}
				} 
				
				
				//Checks if it gets info from Panel Add Or Update
				else if(whichPanel == 2) {
					lblUpdateMessage.setText("");
					int userType = comboBoxUpdate.getSelectedIndex();
					String username = textFieldUsernameUpdate.getText();
					char[] password = passwordFieldUpdate.getPassword();
					String fName = textFieldFNameUpdate.getText();
					String lName = textFieldLNameUpdate.getText();
					String DOB = textFieldDobUpdate.getText();
					String email = textFieldEmailUpdate.getText();
					
					updateUserAdminController adminConUpdate = new updateUserAdminController();
					
					if(checkNull(username, password, fName) == true) {
						lblUpdateMessage.setText("Please key in all required fields");
					}
					
					else {
					switch(userType) {
					
					//Update admin
					case 0:
						if(lName.isBlank()) {
							lblUpdateMessage.setText("Please key in all required fields");
							break;
						}
					else if (adminConUpdate.updateAdminAcc(username, password, fName, lName) == true) {
							successResetUpdate();
							retrieveUserAcc();
							lblUpdateMessage.setText("Succesfully Updated");
							break;
						}
						
					//Update doctor
					case 1:
						int patientID = 0;
						//Checks if a number is entered
						try {
							patientID = Integer.parseInt(textFieldPatientIdUpdate.getText());
						} catch(NumberFormatException r) {
							lblUpdateMessage.setText("Please enter patient ID");
							break;
						}
						
						if(lName.isBlank()) {
							lblUpdateMessage.setText("Please key in all required fields");
							break;
						}
						
						else if(adminConUpdate.updateDoctorAcc(username, password, fName, lName, patientID) == true) {
							lblUpdateMessage.setText("Succesfully Updated");
							successResetUpdate();
							retrieveUserAcc();
							break;
						} 
						else {
							break;
						}
						
					//Update patient
					case 2:
						//Check if dob and email textboxes are filled
						if (checkPatientInfo(DOB,email) == true) {
							lblUpdateMessage.setText("Please enter DOB & email");
							break;
						}
						//Check if DOB is following the correct format by checking length of string
						else if(DOB.length() != 8) {
							lblUpdateMessage.setText("DOB needs to be in DDMMYYYY format");
							break;
						}
						else if(lName.isBlank()) {
							lblUpdateMessage.setText("Please key in all required fields");
							break;
						}
						else {
							//Check if DOB is all integers
							try {
								int tryDOB = Integer.parseInt(textFieldDobUpdate.getText());
							} catch(NumberFormatException r) {
								lblUpdateMessage.setText("Please enter DOB in numerals");
								break;
							}
						}
						
						if(adminConUpdate.updatePatientAcc(username, password, fName, lName, DOB, email)) {
							lblUpdateMessage.setText("Success!");
							successResetUpdate();
							retrieveUserAcc();
							break;
						}
						else {
							break;
						}
						
					//Update pharmacist table
					case 3:
						if(adminConUpdate.updatePharmacistAcc(username, password, fName)){
							lblUpdateMessage.setText("Success!");
							successResetUpdate();
							retrieveUserAcc();
							break;
						}
						else {
							break;
						}
					}
				}
			}
			}
		});
		contentPane.add(btnConfirm, "cell 0 1,alignx right");
		
	}
	
	//Check if the values are empty
	public boolean checkNull(String username, char[] password, String fName) {
		if(username.isBlank() || String.valueOf(password).isBlank() || fName.isBlank()) {
			return true;
		}
		else {
			return false;
		}
	}
	
	
	//Check if DOB and Email fielda re empty
	public boolean checkPatientInfo(String DOB,String email) {
		if (DOB.isBlank() || email.isBlank()) {
			return true;
		} 
		else {
			return false;
		}
	}
	
	//Just refreshes all the textField
	public void successReset() {
		textFieldUsernameAdd.setText(null);
		passwordFieldAdd.setText(null);
		textFieldFirstNameAdd.setText(null);
		textFieldLastNameAdd.setText(null);
		textFieldDOB.setText(null);
		textFieldEmail.setText(null);
		textFieldPatientID.setText(null);
	}
	
	//Just refreshes all the textField for unpdate panel
	public void successResetUpdate() {
		textFieldUsernameUpdate.setText(null);
		passwordFieldUpdate.setText(null);
		textFieldFNameUpdate.setText(null);
		textFieldLNameUpdate.setText(null);
		textFieldDobUpdate.setText(null);
		textFieldEmailUpdate.setText(null);
		textFieldPatientIdUpdate.setText(null);
	}
	
	//Retrieve any user account info
	public void retrieveUserAcc() {
		String username = textFieldUsernameUpdate.getText();
		updateUserAdminController adminConUpdate = new updateUserAdminController();
		
		switch(updateComboBoxValue) {
		//Admin
		case 0:
			String[] adminAccInfo = adminConUpdate.retrieveAdminAcc(username);
			if (adminAccInfo != null) {
			setUpdateEditable();
			String pass = adminAccInfo[0];
			String Fname = adminAccInfo[1];
			String Lname = adminAccInfo[2];
			passwordFieldUpdate.setText(pass);
			textFieldFNameUpdate.setText(Fname);
			textFieldLNameUpdate.setText(Lname);
			break;
			} else {
				setUpdateUneditable();
				setBlankUpdate();
				break;
			}
			
		//Doctor
		case 1:
			String[] doctorAccInfo = adminConUpdate.retrieveDoctorAcc(username);
			if (doctorAccInfo != null) {
			setUpdateEditable();
			String pass = doctorAccInfo[0];
			String Fname = doctorAccInfo[1];
			String Lname = doctorAccInfo[2];
			String patientID = doctorAccInfo[3];
			passwordFieldUpdate.setText(pass);
			textFieldFNameUpdate.setText(Fname);
			textFieldLNameUpdate.setText(Lname);
			textFieldPatientIdUpdate.setText(patientID);
			break;
			} else {
				setUpdateUneditable();
				setBlankUpdate();
				break;
			}
		
		//Patient
		case 2:
			String[] patientAccInfo = adminConUpdate.retrievePatientAcc(username);
			if (patientAccInfo != null) {
			setUpdateEditable();
			String pass = patientAccInfo[0];
			String Fname = patientAccInfo[1];
			String Lname = patientAccInfo[2];
			String dob = patientAccInfo[3];
			String email = patientAccInfo[4];
			passwordFieldUpdate.setText(pass);
			textFieldFNameUpdate.setText(Fname);
			textFieldLNameUpdate.setText(Lname);
			textFieldDobUpdate.setText(dob);
			textFieldEmailUpdate.setText(email);
			break;
			} else {
				setUpdateUneditable();
				setBlankUpdate();
				break;
			}
		
		//Pharmacist
		case 3:
			String[] pharmacistAccInfo = adminConUpdate.retrievePharmacistAcc(username);
			if (pharmacistAccInfo != null) {
			setUpdateEditable();
			String pass = pharmacistAccInfo[0];
			String pharmaName = pharmacistAccInfo[1];
			passwordFieldUpdate.setText(pass);
			textFieldFNameUpdate.setText(pharmaName);
			break;
			} else {
				setUpdateUneditable();
				setBlankUpdate();
				break;
			}
		}
	}
	
	//Sets the field blank
	public void setBlankUpdate() {
		passwordFieldUpdate.setText(null);
		textFieldFNameUpdate.setText(null);
		textFieldLNameUpdate.setText(null);
		textFieldDobUpdate.setText(null);
		textFieldEmailUpdate.setText(null);
		textFieldPatientIdUpdate.setText(null);
	}
	
	public void setUpdateUneditable() {
		passwordFieldUpdate.setEnabled(false);
		textFieldFNameUpdate.setEnabled(false);
		textFieldLNameUpdate.setEnabled(false);
		textFieldDobUpdate.setEnabled(false);
		textFieldEmailUpdate.setEnabled(false);
		textFieldPatientIdUpdate.setEnabled(false);
	}
	
	public void setUpdateEditable() {
		passwordFieldUpdate.setEnabled(true);
		textFieldFNameUpdate.setEnabled(true);
		textFieldLNameUpdate.setEnabled(true);
		if (updateComboBoxValue == 1) {
			textFieldPatientIdUpdate.setEnabled(true);
		}
		else if (updateComboBoxValue == 2) {
			textFieldDobUpdate.setEnabled(true);
			textFieldEmailUpdate.setEnabled(true);
		}
		else if (updateComboBoxValue == 3) {
			textFieldLNameUpdate.setEnabled(false);
		}
		
	}
	
}
