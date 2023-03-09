<?xml version="1.0" encoding="UTF-8"?>


<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
<html>
  <head>
    <title>Users List</title>
    <link rel="stylesheet" type="text/css" href="../../../../public/css/XSL.css" />

  </head>
  <body>
    
    <div class="wrapper" style="color:Blue;">
      <h1>Users List</h1>
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone Number</th>
        </tr>
        <!-- 
          XPath expressions are used in the <xsl:for-each> statements to select specific nodes from the input XML document based on certain criteria. 
         -->
        <xsl:for-each select="users/user[starts-with(name, 'User')]">
          <tr>
            <td><xsl:value-of select="id"/></td>
            <td><xsl:value-of select="name"/></td>
            <td><xsl:value-of select="email"/></td>
            <td><xsl:value-of select="phone_number"/></td>
          </tr>
        </xsl:for-each>
      </table>
      <h1>Editor List</h1>
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone Number</th>
        </tr>
        <xsl:for-each select="users/user[starts-with(name, 'Editor')]">
          <tr>
            <td><xsl:value-of select="id"/></td>
            <td><xsl:value-of select="name"/></td>
            <td><xsl:value-of select="email"/></td>
            <td><xsl:value-of select="phone_number"/></td>
          </tr>
                    </xsl:for-each>
                </table>
                <h1>Admin List</h1>
                
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                    </tr>
                    <!-- <xsl:for-each select="users/user"> -->
                     <xsl:for-each select="users/user[starts-with(name, 'Admin')]">

                        <tr>
                            <td><xsl:value-of select="id"/></td>
                            <td><xsl:value-of select="name"/></td>
                            <td><xsl:value-of select="email"/></td>
                            <td><xsl:value-of select="phone_number"/></td>
                        </tr>
                    </xsl:for-each>
                </table>
                </div>
                <script src="XSL.css"></script>

            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
