import org.hoydaa.codesnippet.util.SnippetConfig;

public class SnippetConfigProxy {
	public SnippetConfigProxy() {
			
	}
	
	public SnippetConfig getSnippetConfig(String language) {
		if(language.equals("java"))
			return new SnippetConfig(SnippetConfig.Language.JAVA);
		if(language.equals("c"))
			return new SnippetConfig(SnippetConfig.Language.C);
		if(language.equals("php"))
			return new SnippetConfig(SnippetConfig.Language.PHP);
		else
			return new SnippetConfig(SnippetConfig.Language.XML);			
	}	
	
}