<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <title>Category List</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css/XSL.css" />
        <style>
        td {
          text-align:center;
        }
        </style>
      </head>
      <body>
        <div class="wrapper" style="color:Blue;">
          <h1>Category List</h1>
          <table>
            <tr>
              <th>id</th>
              <th>name</th>
              <th>status</th>
              <th>created_at</th>
              <th>updated_at</th>

            </tr>
            <xsl:for-each select="categories/category[status='active']">
              <tr>
                <td><xsl:value-of select="id"/></td>
                <td><xsl:value-of select="name"/></td>
                <td><xsl:value-of select="status"/></td>
                <td><xsl:value-of select="created_at"/></td>
                <td><xsl:value-of select="updated_at"/></td>

              </tr>
            </xsl:for-each>
          </table>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>