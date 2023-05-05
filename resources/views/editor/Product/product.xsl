<?xml version="1.0" encoding="UTF-8"?>


<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <html>
            <head>
                <title>Product List</title>
                <link rel="stylesheet" type="text/css" href="../../../../public/css/XSL.css"  />
            </head>
            <body>

                <div class="wrapper" style="color:Blue;">
                    <h1>Product List</h1>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Category ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                        </tr>
                        <!-- 
          XPath expressions are used in the <xsl:for-each> statements to select specific nodes from the input XML document based on certain criteria. 
         -->
                        <xsl:for-each select="products/product">
                             <tr>
                                <td>
                                    <xsl:value-of select="id"/>
                                </td>
                                <td>
                                    <xsl:value-of select="category_id"/>
                                </td>
                                <td>
                                    <xsl:value-of select="name"/>
                                </td>
                                <td>
                                    <xsl:value-of select="price"/>
                                </td>
                                <td>
                                    <xsl:value-of select="description"/>
                                </td>
                            </tr>
                        </xsl:for-each>
                    </table>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
