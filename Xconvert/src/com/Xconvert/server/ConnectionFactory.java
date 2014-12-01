package com.Xconvert.server;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
public class ConnectionFactory {
    //static reference to itself
    private static ConnectionFactory instance = 
                new ConnectionFactory();
    
    String url = "jdbc:mysql://localhost/edplayground";
    String user = "root";
    String password = "secret123";
    String driverClass = "com.mysql.jdbc.Driver"; 
     
    //private constructor
    private ConnectionFactory() {
        try {
            Class.forName(driverClass);
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }
    }
     
    public static ConnectionFactory getInstance()   {
        return instance;
    }
     
    public Connection getConnection() throws SQLException, 
    ClassNotFoundException {
    	
    	//TODO: get these accounts from a static file properties file eg.
        Connection connection = 
            DriverManager.getConnection(url, user, password);
        return connection;
    }   
}