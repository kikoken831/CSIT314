package tFanClubProject;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import net.miginfocom.swing.MigLayout;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JTextField;
import javax.swing.JComboBox;
import javax.swing.DefaultComboBoxModel;
import javax.swing.JButton;
import java.awt.Color;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

public class updateStatusPharmacist extends JFrame {

	private JPanel contentPane;
	private JTextField textFieldSearchPrescription;
	private JTextField textFieldDateDispensed;
	private JTextField textFieldMedicationName;
	private JTextField textFieldDosage;
	int comboBoxValue = 0;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					String username = null;
					String pharmaID = null;
					updateStatusPharmacist frame = new updateStatusPharmacist(username,pharmaID);
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
	public updateStatusPharmacist(String username, String pharmaID) {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 581, 333);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(new MigLayout("", "[][grow]", "[][][][][][][][][][]"));
		
		JLabel lblHeader = new JLabel("Update Prescription Status");
		lblHeader.setFont(new Font("Tahoma", Font.PLAIN, 13));
		contentPane.add(lblHeader, "cell 0 0");
		
		JLabel lblSearchToken = new JLabel("Search Token : ");
		contentPane.add(lblSearchToken, "cell 0 3,alignx trailing");
		
		JLabel lblMessage = new JLabel("");
		lblMessage.setForeground(Color.RED);
		contentPane.add(lblMessage, "cell 1 8");
		
		JLabel lblDateDispensed = new JLabel("Date Dispensed : ");
		contentPane.add(lblDateDispensed, "cell 0 4,alignx trailing");
		
		textFieldDateDispensed = new JTextField();
		contentPane.add(textFieldDateDispensed, "flowx,cell 1 4");
		textFieldDateDispensed.setColumns(10);
		
		JLabel lblMedicationName = new JLabel("Medication Name : ");
		contentPane.add(lblMedicationName, "cell 0 5,alignx trailing");
		
		textFieldMedicationName = new JTextField();
		textFieldMedicationName.setEditable(false);
		contentPane.add(textFieldMedicationName, "cell 1 5");
		textFieldMedicationName.setColumns(10);
		
		JLabel lblDosage = new JLabel("Dosage : ");
		contentPane.add(lblDosage, "cell 0 6,alignx trailing");
		
		textFieldDosage = new JTextField();
		textFieldDosage.setEditable(false);
		contentPane.add(textFieldDosage, "cell 1 6");
		textFieldDosage.setColumns(10);
		
		JLabel lblStatus = new JLabel("Status : ");
		contentPane.add(lblStatus, "cell 0 7,alignx trailing");
		
		JComboBox comboBoxStatus = new JComboBox();
		comboBoxStatus.setModel(new DefaultComboBoxModel(new String[] {"Dispensed", "Pending"}));
		contentPane.add(comboBoxStatus, "cell 1 7");
		
		textFieldSearchPrescription = new JTextField();
		contentPane.add(textFieldSearchPrescription, "cell 1 3");
		textFieldSearchPrescription.setColumns(10);
		textFieldSearchPrescription.addKeyListener(new KeyAdapter() {
			@Override
			public void keyReleased(KeyEvent e) {
				if (textFieldSearchPrescription.getText().isBlank()) {
					resetTextfields();
					lblMessage.setText(null);
				} 
				
				else {
					try {
						String token = textFieldSearchPrescription.getText();
						retrievePrescriptionInfo(token);
						comboBoxStatus.setSelectedIndex(comboBoxValue);
						lblMessage.setText(null);
					} catch (Exception f) {
						lblMessage.setText("No such token");
					}
				}
				
			}
		});
		
		JButton btnUpdate = new JButton("Update");
		btnUpdate.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				getTodayDate();
				Integer tryDate = 0;
				int presNum = 0;
				String date = textFieldDateDispensed.getText();
				String medicationName = textFieldMedicationName.getText();
				String dosage = textFieldDosage.getText();
				
				if (textFieldSearchPrescription.getText().isBlank()) {
					lblMessage.setText("Please enter a prescription token");
				} 
				
				else if(date.isBlank()) {
					lblMessage.setText("Please enter a date");
				}
				
				else if(date.length() != 8) {
					lblMessage.setText("Please enter a date in DDMMYYYY format");
				}
				
				else if(medicationName.isBlank() || dosage.isBlank()) {
					lblMessage.setText("Please enter a valid prescription ID");
				}
				
				else {
					try {
						tryDate = Integer.parseInt(textFieldDateDispensed.getText());
						if(tryDate != null) {
							String comboValue = comboBoxStatus.getSelectedItem().toString();
							String token = textFieldSearchPrescription.getText();
							updateStatusPharmacistController presCon = new updateStatusPharmacistController();
							presCon.updatePrescriptionInfo(token, date, comboValue, pharmaID);
							lblMessage.setText("Successfully Updated");
							resetTextfields();
								
							}
					} catch(NumberFormatException r) {
						lblMessage.setText("Please enter DOB in numerals");
					}

				}

			}
		});
		
		JButton btnBack = new JButton("Back");
		btnBack.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				homePagePharmacist homepage = new homePagePharmacist(username);
				homepage.setVisible(true);
				dispose();
			}
		});
		contentPane.add(btnBack, "flowx,cell 1 9,alignx right");
		contentPane.add(btnUpdate, "cell 1 9,alignx right");
		
		JButton btnGetDate = new JButton("Get Today's Date");
		btnGetDate.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				
				String date = getTodayDate();
				textFieldDateDispensed.setText(date);
			}
		});
		contentPane.add(btnGetDate, "cell 1 4");
		
	}
	
	
	public void retrievePrescriptionInfo(String token) {
		//Clears previous values from textbox
		textFieldDateDispensed.setText(null);
		textFieldMedicationName.setText(null);
		textFieldDosage.setText(null);
		
		updateStatusPharmacistController con = new updateStatusPharmacistController();
		String[] info = con.passPrescriptionInfo(token);
		textFieldDateDispensed.setText(info[1]);
		textFieldMedicationName.setText(info[3]);
		textFieldDosage.setText(info[4]);

		if (info[2].trim().toLowerCase().equals("dispensed")) {
			comboBoxValue = 0;
		} else if (info[2].trim().toLowerCase().equals("pending")) {
			comboBoxValue = 1;
		}
	}
	
	public void resetTextfields() {
		textFieldSearchPrescription.setText(null);
		textFieldDateDispensed.setText(null);
		textFieldMedicationName.setText(null);
		textFieldDosage.setText(null);
	}
	
	public String getTodayDate() {

		  DateTimeFormatter dtf = DateTimeFormatter.ofPattern("ddMMuuuu");
		  LocalDate localDate = LocalDate.now();
		  String date = dtf.format(localDate).toString();
		  return date;
	}

}
