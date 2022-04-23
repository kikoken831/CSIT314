package tFanClubProject;

	import java.awt.Color;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;
import java.sql.SQLException;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;

public class homePageDoctor extends JFrame {

	int doctorID = 0;
	private JPanel contentPane;
	private JTextField textFieldPname;

	private JTable table_1;

	private homePageDoctorController homePageDoctorController;

	/**
	 * Launch the application.
	 */

	/**
	 * Create the frame.
	 * 
	 * @throws SQLException
	 */
	public homePageDoctor(String username) throws SQLException {
		homePageDoctorController = new homePageDoctorController();
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 626, 517);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		homePageDoctorController docCon = new homePageDoctorController();
		doctorID = docCon.getDoctorID(username);
		System.out.print(doctorID);

		textFieldPname = new JTextField();
		textFieldPname.addKeyListener(new KeyAdapter() {
			@Override
			public void keyReleased(KeyEvent e) {
				try {
					System.out.println(doctorID);
					table_1.setModel(homePageDoctorController.getPatient(textFieldPname.getText()));
				} catch (Exception f) {
					f.printStackTrace();
				}
			}
		});
		textFieldPname.setFont(new Font("Courier New", Font.ITALIC, 11));
		textFieldPname.setBounds(179, 141, 179, 30);
		contentPane.add(textFieldPname);
		textFieldPname.setColumns(10);

		JLabel lblheader = new JLabel("Doctor");
		lblheader.setBounds(10, 29, 99, 52);
		lblheader.setFont(new Font("Verdana", Font.BOLD, 24));
		contentPane.add(lblheader);

		JLabel lblPname = new JLabel("Search patient ID:");
		lblPname.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblPname.setBounds(10, 141, 179, 30);	
		contentPane.add(lblPname);

//		JButton btnAllPatients = new JButton("All Patients");
//		btnAllPatients.addActionListener(new ActionListener() {
//			public void actionPerformed(ActionEvent e) {
//			}
//		});
//		btnAllPatients.setBounds(198, 75, 117, 30);
//		contentPane.add(btnAllPatients);

		JButton btnLogout = new JButton("Logout");
		btnLogout.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JFrame loginPage = new LoginPage();
				loginPage.setVisible(true);

				dispose();
			}
		});
		btnLogout.setBounds(498, 35, 89, 30);
		contentPane.add(btnLogout);

		JLabel lblProblem = new JLabel("");
		lblProblem.setFont(new Font("Tahoma", Font.PLAIN, 10));
		lblProblem.setForeground(Color.RED);
		lblProblem.setBounds(110, 60, 205, 35);
		contentPane.add(lblProblem);

		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(10, 193, 592, 252);
		contentPane.add(scrollPane);

		table_1 = new JTable();
		scrollPane.setViewportView(table_1);

		JButton btnView = new JButton("View");
		btnView.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				int selectedRow = table_1.getSelectedRow();
				int id = 0;
				if (selectedRow >= 0) {
					String patientId = table_1.getValueAt(selectedRow, 0).toString();

					try {
						id = Integer.parseInt(patientId);
					} catch (Exception f) {

					}
					doctorInfo doctorInfo;
					try {
						doctorInfo = new doctorInfo(id, username, doctorID);
						doctorInfo.setDefaultCloseOperation(JFrame.HIDE_ON_CLOSE); // frame will hide on close, it will
																					// not terminate the program
						doctorInfo.loadTable();
						doctorInfo.setVisible(true);
						dispose();
					} catch (SQLException e1) {
						// TODO Auto-generated catch block
						e1.printStackTrace();
					}

					// you've passed the user and pass to other frame.
					// then you can make it visible.

				} else {
					JOptionPane.showMessageDialog(null, "Please select a patient first!", "Error",
							JOptionPane.ERROR_MESSAGE);
				}
			}
		});
		btnView.setBounds(378, 149, 89, 23);
		contentPane.add(btnView);

//		btnAllPatients.addActionListener(new ActionListener() {
//			public void actionPerformed(ActionEvent e) {
//				try {
//					System.out.println(doctorID);
//					table_1.setModel(homePageDoctorController.getAllPatients(doctorID));
//
//				} catch (Exception f) {
//					f.printStackTrace();
//				}

				// Check null
				if (textFieldPname.getText().isEmpty()) {
					lblProblem.setText("Please enter Patient Name");
				}
		}
}
